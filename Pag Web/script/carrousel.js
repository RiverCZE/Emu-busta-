var mygallery=new fadeSlideShow({
  wrapperid: "carrousel", //ID of blank DIV on page to house Slideshow
  dimensions: [622, 145], //width/height of gallery in pixels. Should reflect dimensions of largest image
  imagearray: [
    ["images/carrousel/XP.png", "?pagina=event", "", ""],
    ["images/carrousel/ladder.png", "?pagina=ladder", "", ""],
    //["images/carrousel/shop.png", "?pagina=shop", "", ""]
  ],
  displaymode: {type:'auto', pause:10000, cycles:0, wraparound:false},
  persist: false, //remember last viewed slide and recall within same session?
  fadeduration: 500, //transition duration (milliseconds)
  descreveal: "none",
  togglerid: ""
})