// JavaScript Document
// UltimateIDX Menu Creator
// Details http://www.ultimateidx.com
/*
function externalLinks() {
 if (!document.getElementsByTagName) return;
 var anchors = document.getElementsByTagName("a");
 for (var i=0; i<anchors.length; i++) {
   var anchor = anchors[i];
   if (anchor.getAttribute("href") &&
       anchor.getAttribute("rel") == "external")
     anchor.target = "_blank";
 }
}
window.onload = externalLinks;
*/
// updated for the new feature of "external nofollow"
function externalLinks() {
 if (!document.getElementsByTagName) return;
 var anchors = document.getElementsByTagName("a");
 for (var i=0; i<anchors.length; i++) {
   var anchor = anchors[i];
   if (anchor.getAttribute("href") && (anchor.getAttribute("rel") == "external" || anchor.getAttribute("rel") == "external nofollow"))
     anchor.target = "_blank";
 }
}
window.onload = externalLinks;