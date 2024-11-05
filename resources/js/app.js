import { initTWE, Carousel } from "tw-elements";
import "./../../vendor/power-components/livewire-powergrid/dist/powergrid";
import "./../../vendor/power-components/livewire-powergrid/dist/tailwind.css";
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import TomSelect from "tom-select";
window.TomSelect = TomSelect;
window.flatpickr = flatpickr;
import "swiper/css/bundle";
import Swiper from "swiper/bundle";
import "./bootstrap";

window.Swiper = Swiper;

initTWE({ Carousel });
