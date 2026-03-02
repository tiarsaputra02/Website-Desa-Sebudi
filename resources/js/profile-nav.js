document.addEventListener("DOMContentLoaded", () => {
  const slider = document.getElementById("desa-slider");
  const nextBtn = document.getElementById("nextBtn");
  const prevBtn = document.getElementById("prevBtn");

  if (!slider) return;

  let index = 0;

  function getStep() {
    return window.innerWidth >= 768 ? 33.3333 : 100;
  }

  nextBtn.addEventListener("click", () => {
    const maxIndex =
      slider.children.length - (window.innerWidth >= 768 ? 3 : 1);

    if (index < maxIndex) {
      index++;
      slider.style.transform = `translateX(-${index * getStep()}%)`;
    }
  });

  prevBtn.addEventListener("click", () => {
    if (index > 0) {
      index--;
      slider.style.transform = `translateX(-${index * getStep()}%)`;
    }
  });
});

