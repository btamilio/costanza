 
require("bootstrap");


 // Added: Actual Bootstrap JavaScript dependency
import 'bootstrap';

import jQuery from "jquery";
window.$ = jQuery;

 // Added: Popper.js dependency for popover support in Bootstrap
import '@popperjs/core';

$(function () {
  console.log("HOW ARE YOU GENTLEMEN?");
});    


