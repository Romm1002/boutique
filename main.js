//
// Variables
//
var btnEditerProduit = Array.from(document.getElementsByClassName('editerProduit'));
var inputText = Array.from(document.getElementsByClassName('input-text'));
var inputNumber = Array.from(document.getElementsByClassName('input-number'));
var inputSubmit = Array.from(document.getElementsByClassName('input-submit'));
var spanNone = Array.from(document.getElementsByClassName('none'));

//
// Tests
//
// console.log(btnEditerProduit);

//
// Fonctions
//
btnEditerProduit.forEach(element => {
    element.addEventListener('click', function(){
        spanNone.forEach(element => {
            element.style.display = 'none';
        });
        inputText.forEach(element => {
            element.type = 'text';
        });
        inputNumber.forEach(element => {
            element.type = 'number';
        });
        inputSubmit.forEach(element => {
            element.type = 'submit';
        });
    });
});