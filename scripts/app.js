function showMessage(input, message, valid) {
    const messageElement = document.getElementById(input.id + "-message");

    input.classList.toggle("input-error", !valid);
    input.classList.toggle("input-valid", valid);

    if (messageElement) {
        messageElement.textContent = message;
        messageElement.classList.toggle("error-text", !valid && message !== "");
        messageElement.classList.toggle("success-text", valid && message !== "");
    }
}

function validateRequired(input, message) {
    const valid = input.value.trim() !== "";
    showMessage(input, valid ? "" : message, valid);
    return valid;
}

function validateEmail(input) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const valid = emailPattern.test(input.value.trim());
    showMessage(input, valid ? "" : "Insira um e-mail valido.", valid);
    return valid;
}

function validatePassword(input) {
    const valid = input.value.length >= 4;
    showMessage(input, valid ? "" : "A password deve ter pelo menos 4 caracteres.", valid);
    return valid;
}

function setupProjectToggle() {
    const button = document.getElementById("toggle-info");
    const details = document.getElementById("project-details");

    if (!button || !details) {
        return;
    }

    button.addEventListener("click", function () {
        details.classList.toggle("hidden");
        button.textContent = details.classList.contains("hidden")
            ? "Mostrar informacao do projeto"
            : "Ocultar informacao do projeto";
    });
}

function setupRegisterForm() {
    const form = document.getElementById("form-registo");

    if (!form) {
        return;
    }

    const nome = document.getElementById("nome");
    const username = document.getElementById("username");
    const password = document.getElementById("password");

    nome.addEventListener("input", function () {
        validateRequired(nome, "Insira o seu nome.");
    });
    username.addEventListener("input", function () {
        validateEmail(username);
    });
    password.addEventListener("input", function () {
        validatePassword(password);
    });

    form.addEventListener("submit", function (event) {
        const validName = validateRequired(nome, "Insira o seu nome.");
        const validEmail = validateEmail(username);
        const validPassword = validatePassword(password);

        if (!validName || !validEmail || !validPassword) {
            event.preventDefault();
        }
    });
}

function setupTicketForm() {
    const form = document.getElementById("form-bilhete");

    if (!form) {
        return;
    }

    const params = new URLSearchParams(window.location.search);
    const gameName = params.get("jogo") || "Clube vs Rival FC";
    const gameTitle = document.getElementById("nome-jogo");
    const gameInput = document.getElementById("jogo");
    const priceInput = document.getElementById("preco");
    const quantityInput = document.getElementById("quantidade");
    const summary = document.getElementById("resumo-bilhete");
    const message = document.getElementById("bilhete-message");

    gameTitle.textContent = gameName;
    gameInput.value = gameName;

    function updateSummary() {
        const selectedTicket = form.querySelector("input[name='zona']:checked");
        const quantity = Number(quantityInput.value);

        if (!selectedTicket) {
            summary.textContent = "Escolha uma zona para ver o total.";
            priceInput.value = "";
            return false;
        }

        if (quantity < 1 || quantity > 4) {
            summary.textContent = "A quantidade deve estar entre 1 e 4 bilhetes.";
            return false;
        }

        const price = Number(selectedTicket.dataset.preco);
        const total = price * quantity;
        priceInput.value = String(price);
        summary.textContent = selectedTicket.dataset.label + " | " + quantity + " bilhete(s) | Total: " + total.toFixed(2) + " EUR";
        return true;
    }

    form.addEventListener("change", updateSummary);
    quantityInput.addEventListener("input", updateSummary);

    form.addEventListener("submit", function (event) {
        const selectedTicket = form.querySelector("input[name='zona']:checked");
        const validQuantity = Number(quantityInput.value) >= 1 && Number(quantityInput.value) <= 4;

        if (!selectedTicket || !validQuantity || !updateSummary()) {
            event.preventDefault();
            message.textContent = "Escolha uma zona e uma quantidade valida.";
            message.classList.add("error-text");
        }
    });
}

function setupPaymentForm() {
    const form = document.getElementById("form-pagamento");

    if (!form) {
        return;
    }

    const params = new URLSearchParams(window.location.search);
    const game = params.get("jogo") || "Jogo selecionado";
    const zone = params.get("zona") || "bilhete";
    const quantity = Number(params.get("quantidade") || "1");
    const price = Number(params.get("preco") || "0");
    const total = price * quantity;
    const summary = document.getElementById("resumo-pagamento");
    const card = document.getElementById("cartao");
    const successMessage = document.getElementById("mensagem-pagamento");

    summary.innerHTML = "Jogo: <strong>" + game + "</strong><br>Bilhete: <strong>" + zone + "</strong><br>Total a pagar: <strong>" + total.toFixed(2) + " EUR</strong>";

    card.addEventListener("input", function () {
        card.value = card.value.replace(/\D/g, "").replace(/(.{4})/g, "$1 ").trim().slice(0, 19);
    });

    form.addEventListener("submit", function (event) {
        const digits = card.value.replace(/\D/g, "");
        const valid = digits.length === 16;
        showMessage(card, valid ? "" : "O numero do cartao deve ter 16 digitos.", valid);

        if (!valid) {
            event.preventDefault();
            return;
        }

        event.preventDefault();
        successMessage.classList.remove("hidden");
        form.reset();
    });
}

function setupAdminForm() {
    const form = document.getElementById("form-admin");

    if (!form) {
        return;
    }

    const adversario = document.getElementById("adversario");
    const date = document.getElementById("data-jogo");
    const time = document.getElementById("hora-jogo");
    const capacity = document.getElementById("lotacao");
    const price = document.getElementById("preco-admin");
    const preview = document.getElementById("admin-preview");

    function updatePreview() {
        preview.textContent = adversario.value.trim()
            ? "Novo evento contra " + adversario.value.trim() + " em " + (date.value || "data por definir") + " as " + (time.value || "hora por definir") + "."
            : "Preencha os dados para previsualizar o evento.";
    }

    [adversario, date, time, capacity, price].forEach(function (input) {
        input.addEventListener("input", updatePreview);
    });

    form.addEventListener("submit", function (event) {
        const validOpponent = validateRequired(adversario, "Insira a equipa adversaria.");
        const validDate = validateRequired(date, "Escolha a data do jogo.");
        const validTime = validateRequired(time, "Escolha a hora do jogo.");
        const validCapacity = Number(capacity.value) > 0;
        const validPrice = Number(price.value) > 0;

        showMessage(capacity, validCapacity ? "" : "A lotacao deve ser superior a zero.", validCapacity);
        showMessage(price, validPrice ? "" : "O preco deve ser superior a zero.", validPrice);

        if (!validOpponent || !validDate || !validTime || !validCapacity || !validPrice) {
            event.preventDefault();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    setupProjectToggle();
    setupRegisterForm();
    setupTicketForm();
    setupPaymentForm();
    setupAdminForm();
});
