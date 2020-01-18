/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css';

Vue.use(ElementUI);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
const files = require.context('./components', true, /\.vue$/i);
files.keys().map(key =>
  Vue.component(
    key
      .split('/')
      .pop()
      .split('.')[0],
    files(key).default
  )
);

$('.dropdown.keep-open').on({
  'shown.bs.dropdown': () => {
    this.closable = false;
  },
  click: () => {
    this.closable = true;
  },
  'hide.bs.dropdown': () => this.closable,
});

$('#collapse1').click(function() {
  $('.box-body1').toggleClass('hide');
});

//Sidebar menu
$('#menu-toggle').click(function(e) {
  e.preventDefault();
  $('#wrapper').toggleClass('toggled');
  $('.sidebar-brand').toggleClass('shownone');
});

$(document).ready(function() {
  $('.dropdown-toggle').dropdown();

  $('.list-group-item').click(function() {
    if ($('.list-group-item').hasClass('collapsed')) {
      $(this)
        .find('.sidebar-arrow')
        .toggleClass('arrow-up')
        .toggleClass('arrow-down');
    } else {
      $(this)
        .find('.sidebar-arrow')
        .toggleClass('arrow-down')
        .toggleClass('arrow-up');
    }
  });
});

$(document).ready(function() {
  $('body').on('click', '.menu-txt-toggle', function() {
    $('body #wrapper').toggleClass('myNavmenu-icons');
  });

  $('html').click(function(evt) {
    const target = $(evt.target);
    if (target.hasClass('mobile-toggle')) {
      setTimeout(function() {
        $('body #wrapper').toggleClass('big-menu');
      }, 0);
    } else {
      if (target.id == 'myNavmenu') return;
      //For descendants of #myNavmenu being clicked, remove this check if you do not want to put constraint on descendants.
      if ($(target).closest('#myNavmenu').length) return;
      if ($(target).closest('#mobile-toggle').length) {
        //Do processing of click event here for every element except with id #myNavmenu
        $('body #wrapper').toggleClass('big-menu');
      } else {
        $('body #wrapper').removeClass('big-menu');
      }
    }
  });
});

$(window).on('resize', function() {
  const win = $(this); //this = window
  if (win.width() >= 991) {
    $('body #wrapper').removeClass('big-menu');
    //$("body .navbar-default .navbar-toggle").trigger("click");
  }
});

$('.search-select').dropdown({
  direction: 'upward',
});

const app = new Vue({
  el: '#wrapper', // #wrapper in master.blade.php
});
