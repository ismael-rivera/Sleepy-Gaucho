// JavaScript Document
   var arr = [ "one", "two", "three", "four", "five" ];
    var obj = { one:1, two:2, three:3, four:4, five:5 };

    jQuery.each(arr, function() {
      $("#" + this).text("Mine is " + this + ".");
       return (this != "three"); // will stop running after "three"
   });

    jQuery.each(obj, function(i, val) {
      $("#" + i).append(document.createTextNode(" - " + val));
    });