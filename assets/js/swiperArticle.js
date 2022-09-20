//import Swiper, { Pagination, Autoplay, EffectCreative } from "swiper";
import Swiper from "swiper/bundle"
import "swiper/scss";
import "swiper/scss/pagination";

// configure Swiper to use modules
//Swiper.use([Pagination, Autoplay, EffectCreative]);

const swiper = new Swiper(".swiper-image", {
  direction: "horizontal",
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: true,
  },
  grabCursor: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true
  },
  effect: 'creative',
  creativeEffect:{
    prev:{
        shadow: true,
        translate: [0, 0, -400]
    },
    next:{
        translate: ["100%", 0, 0]
    }
  }
});