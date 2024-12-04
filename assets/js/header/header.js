const searchWrapper = document.querySelector(".input-pesquisa");
const inputBox = searchWrapper.querySelector("input[type='search']");
const sugestBox = searchWrapper.querySelector(".list-header");

function removeAccents(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

function levenshteinDistance(a, b) {
    const matrix = Array(a.length + 1).fill(null).map(() => Array(b.length + 1).fill(null));

    for (let i = 0; i <= a.length; i++) {
        matrix[i][0] = i;
    }
    for (let j = 0; j <= b.length; j++) {
        matrix[0][j] = j;
    }
    
    for (let i = 1; i <= a.length; i++) {
        for (let j = 1; j <= b.length; j++) {
            const cost = a[i - 1] === b[j - 1] ? 0 : 1;
            matrix[i][j] = Math.min(
                matrix[i - 1][j] + 1,      // Deletion
                matrix[i][j - 1] + 1,      // Insertion
                matrix[i - 1][j - 1] + cost // Substitution
            );
        }
    }
    return matrix[a.length][b.length];
}

inputBox.onkeyup = (e) => {
    let userData = e.target.value;
    let emptyArray = [];

    if (userData) {
        emptyArray = suggestions.filter((data) => {
            const normalizedData = removeAccents(data).toLowerCase();
            const normalizedInput = removeAccents(userData).toLowerCase();
            return levenshteinDistance(normalizedData, normalizedInput) <= 2;
        }).sort((a, b) => {
            return levenshteinDistance(removeAccents(a).toLowerCase(), normalizedInput) -
                   levenshteinDistance(removeAccents(b).toLowerCase(), normalizedInput);
        });

        emptyArray = emptyArray.map((data) => `<li>${data}</li>`);
        searchWrapper.classList.add("active");
        showSuggestions(emptyArray);

        let allList = sugestBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            allList[i].setAttribute("onclick", "select(this)");
        }

        if (e.key === 'Escape') {
            searchWrapper.classList.remove("active");
        }
    } else {
        searchWrapper.classList.remove("active");
    }
};

function select(element) {
    let selectData = element.textContent;
    inputBox.value = selectData;
    searchWrapper.classList.remove("active");
}

function showSuggestions(list) {
    let listData;
    if (!list.length) {
        listData = `<li>Nenhuma sugestão encontrada</li>`;
    } else {
        listData = list.join('');
    }
    sugestBox.innerHTML = listData;
}

inputBox.onkeyup = (e) => {
    let userData = e.target.value.trim(); // Remover espaços em branco
    let emptyArray = [];

    if (userData) {
        emptyArray = suggestions.filter((data) => {
            const normalizedData = removeAccents(data).toLowerCase();
            const normalizedInput = removeAccents(userData).toLowerCase();
            return normalizedData.includes(normalizedInput); // Verifica se o termo está contido em qualquer parte da sugestão
        });

        emptyArray = emptyArray.map((data) => `<li>${data}</li>`);
        searchWrapper.classList.add("active");
        showSuggestions(emptyArray);

        let allList = sugestBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            allList[i].setAttribute("onclick", "select(this)");
        }

        if (e.key === 'Escape') {
            searchWrapper.classList.remove("active");
        }
    } else {
        searchWrapper.classList.remove("active");
    }
};
