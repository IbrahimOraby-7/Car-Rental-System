function allimg() {
    const imgs = document.querySelectorAll("img");
    imgs.forEach((img) => {
      img.addEventListener("mouseenter", () => {
        img.style.transform = `scale(1.05)`;
      });
      img.addEventListener("mouseout", () => {
        img.style.transform = `scale(1)`;
      });
    });
  }
  
  allimg();