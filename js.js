
  let total = 0;
  const cartItems = document.getElementById("cart-items");
  const cartTotal = document.getElementById("cart-total");

  // نلقاو جميع الأزرار لي عندهم class add-to-cart
  const buttons = document.querySelectorAll(".add-to-cart");

  buttons.forEach(button => {
    button.addEventListener("click", () => {
      const item = button.parentElement; // العنصر ديال المنتوج
      const name = item.querySelector("h3").textContent; // سميتو
      const price = parseFloat(item.querySelector(".price").textContent); // الثمن

      // نزيدو فاللائحة
      const li = document.createElement("li");
      li.textContent = `${name} - ${price.toFixed(2)} dh`;
      cartItems.appendChild(li);

      // نزيدو للمجموع
      total += price;
      cartTotal.textContent = "Total : dh" + total.toFixed(2);
    });
  });

