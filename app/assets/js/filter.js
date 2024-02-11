export default class Filter {
  constructor() {
    this.selectors = {
      filter: 'form.filter',
      filterId: 'data-filter-id',
      checkbox: 'input[type="checkbox"]',
      clear: '[data-filter-clear]'
    }
    this.filter = document.querySelector(`${this.selectors.filter}`);
    this.filters = this.filter.querySelectorAll(`[${this.selectors.filterId}]`);
    this.handlerSubmit = this.handlerSubmit.bind(this);
    this.handlerClick = this.handlerClick.bind(this);
  }

  init() {
    this.filter.addEventListener('submit', this.handlerSubmit);
    document.addEventListener('click', this.handlerClick);
  }

  handlerClick(event) {
    const { target } = event;
    const clear
        = target.closest(this.selectors.clear);
    if (clear) {
      this.redirect();
    }
  }

  handlerSubmit(event) {
    event.preventDefault();

    const activeFilters = this.getCheckedFilter();

    if (!Object.keys(activeFilters).length) return;

    const filtersString = this.createFiltersString(activeFilters);

    if (!filtersString.length) return;

    this.redirect(filtersString);
  }

  redirect(getParams = '') {
    const currentUrl = window.location.origin + window.location.pathname ;
    window.location.href = currentUrl + `?${getParams}`;
  }

  createFiltersString(filtersObj) {
    let filtersString = '';
    Object.keys(filtersObj).forEach(key => {
      filtersString += `${key}=`;
      filtersString += filtersObj[key].map(item => encodeURIComponent(item.replace(/\*/g, '%2A'))).join('-');
      filtersString += '&';
    });
    filtersString = filtersString.slice(0, -1);
    return filtersString;
  }

  getCheckedFilter() {
    const checkedFilters = {};
    this.filters.forEach((filter) => {
      const filterId = filter.dataset.filterId;
      const checked = this.getCheckedCheckboxes(filter);
      if (checked) checkedFilters[filterId] = checked
    })
    return checkedFilters
  }

  getCheckedCheckboxes(element) {
    const checkboxes
        = element.querySelectorAll(this.selectors.checkbox);
    const checkedCheckboxes = Array.from(checkboxes)
        .map((checkbox) => {
          if (checkbox.checked) {
            return checkbox.nextElementSibling.dataset.value;
          }
          return null
        })
        .filter((label) => label !== null);

    if (checkedCheckboxes.length > 0) return checkedCheckboxes;
    return false;
  }
}
