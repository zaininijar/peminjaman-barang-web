/*
Template Name: Admin Template
Author: Wrappixel

File: js
*/
// ==============================================================
// Auto select left navbar
// ==============================================================
$(function () {
    "use strict";

    function getParameterByName(name, url) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, " "));
  }
    var element = $("ul#sidebarnav a").filter(function () {
      return this.dataset.currentpage === getParameterByName('page');
    });

    element.parentsUntil(".sidebar-nav").each(function (index) {
      if ($(this).is("li") && $(this).children("a").length !== 0) {
        $(this).children("a").addClass("active");
        $(this).parent("ul#sidebarnav").length === 0
          ? $(this).addClass("active")
          : $(this).addClass("selected");
      } else if (!$(this).is("ul") && $(this).children("a").length === 0) {
        $(this).addClass("selected");
      } else if ($(this).is("ul")) {
        $(this).addClass("in");
      }
    });
  
    element.addClass("active");
    $("#sidebarnav a").on("click", function (e) {
      if (!$(this).hasClass("active")) {
        // hide any open menus and remove all other classes
        $("ul", $(this).parents("ul:first")).removeClass("in");
        $("a", $(this).parents("ul:first")).removeClass("active");
  
        // open our new menu and add the open class
        $(this).next("ul").addClass("in");
        $(this).addClass("active");
      } else if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        $(this).parents("ul:first").removeClass("active");
        $(this).next("ul").removeClass("in");
      }
    });
    $("#sidebarnav >li >a.has-arrow").on("click", function (e) {
      e.preventDefault();
    });
  });