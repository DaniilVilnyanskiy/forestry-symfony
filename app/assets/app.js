/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/style.scss';

import Accordion from "./js/accordion";
import Filter from "./js/filter";

const acc = new Accordion();
acc.init();

const filter = new Filter();
filter.init()

// start the Stimulus application
// import './bootstrap';
