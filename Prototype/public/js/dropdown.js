const accordions = document.querySelectorAll(".accordion");
for (const accordion of accordions) {
  const panels = accordion.querySelectorAll(".accordion-panel");
  for (const panel of panels) {
    const head = panel.querySelector(".accordion-header");
    head.addEventListener('click', () => {
      for (const otherPanel of panels) {
        if (otherPanel !== panel) {
          otherPanel.classList.remove('accordion-expanded');
        }
      }
      panel.classList.toggle('accordion-expanded');
    });
  }
}