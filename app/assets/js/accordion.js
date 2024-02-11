export default class Accordion{
  constructor() {
    this.btn = '[data-acc-btn]';
    this.openElement = 'data-acc-open-el'
    this.activeClass = 'active';
    this.handler = this.handler.bind(this);
  }

  init() {
    this.setOpenForActive()
    document.addEventListener('click', this.handler);
  }

  handler(event) {
    const { target } = event;
    const btn
        = target.closest(this.btn);
    if (btn) {
      const btnValue = btn.dataset.accBtn;
      if (!btnValue) return;

      const openElement = this.getOpenElement(btnValue);
      if (openElement) this.toggleShow(openElement)
    }
  }

  toggleShow(element) {
    if (!element) return;

    element.classList.toggle(this.activeClass);
    if (element.classList.contains(this.activeClass)) {
      element.style.height = `${element.scrollHeight}px`;
    } else {
      element.style.height = '0px';
    }
  }

  getOpenElement(value) {
    return document.querySelector(`[${this.openElement}="${value}"]`);
  }

  setOpenForActive() {
    const activeAccordions = document.querySelectorAll(`.active[${this.openElement}]`);
    activeAccordions.forEach((activeItem) => {
      activeItem.style.height = `${activeItem.scrollHeight}px`;
    })
  }
}
