const plus = document.getElementById("plus");
const minus = document.getElementById("minus");
const text = document.getElementById("count-text");
const total_participant = document.getElementById("total_participant");
const totalPriceElement = document.getElementById("total-price");
const realTicketPrice = document.getElementById("realTicketPrice");

const subTotal = document.getElementById("subTotal");
const inputTotalPpn = document.getElementById("totalPpn");
const totalAmount = document.getElementById("totalAmount");

// const pricePerItem = 8559000; // default price per item in Rupiah
const pricePerItem = realTicketPrice.value; // default price per item in Rupiah

function formatRupiah(number) {
    return "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function updateTotalPrice() {
    let currentValue = parseInt(total_participant.value);
    let totalPrice = currentValue * pricePerItem;
    const ppn = 0.11;
    const totalPpn = totalPrice * ppn;
    const grandTotalPrice = totalPrice + totalPpn;
    totalPriceElement.textContent = formatRupiah(grandTotalPrice);

    subTotal.value = totalPrice;
    inputTotalPpn.value = totalPpn;
    totalAmount.value = grandTotalPrice;
}

plus.addEventListener("click", () => {
    let currentValue = parseInt(total_participant.value);
    currentValue++;
    total_participant.value = currentValue;
    text.textContent = currentValue;
    updateTotalPrice();
});

minus.addEventListener("click", () => {
    let currentValue = parseInt(total_participant.value);
    if (currentValue > 1) {
        currentValue--;
        total_participant.value = currentValue;
        text.textContent = currentValue;
        updateTotalPrice();
    }
});

// Initialize total price
updateTotalPrice();
