
  let total = 0;
  const cartItems = document.getElementById("cart-items");
  const cartTotal = document.getElementById("cart-total");

 
  const buttons = document.querySelectorAll(".add-to-cart");

  buttons.forEach(button => {
    button.addEventListener("click", () => {
      const item = button.parentElement; 
      const name = item.querySelector("h3").textContent; 
      const price = parseFloat(item.querySelector(".price").textContent); 

     
      const li = document.createElement("li");
      li.textContent = `${name} - ${price.toFixed(2)} dh`;
      cartItems.appendChild(li);

     
      total += price;
      cartTotal.textContent = "Total : dh" + total.toFixed(2);
    });
  });

