var img = document.getElementsByTagName('img');
console.log(img);


mesImages = 1;


var timer = window.setInterval(changeImage, 4000);


function changeImage() {
    console.log('le timer demarre !');

    mesImages += 1;

    if (mesImages == 9) {
        mesImages = 1;
    }
    img[1].src = 'asset/imageAC/' + mesImages + '.jpg';
}