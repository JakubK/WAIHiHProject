//technologies

let beginningsHeading = document.querySelector('#beginnings > h2');
beginningsHeading.innerText = "Początki mojej przygody z programowaniem";
beginningsHeading.style = "font-size: 1.5em;";

let beginningsSection = document.getElementById("beginnings");
let technologiesSection = document.createElement("section");
technologiesSection.innerHTML = `
    <h2>Technologie</h2>
    <p>Od zawsze interesował mnie język C# wraz z platformą .NET, jednakże niedawno zainteresowałem się również Javascriptem oraz frameworkami takimi jak Vue.js oraz React</p>`;
beginningsSection.parentNode.insertBefore(technologiesSection,beginningsSection.nextSibling);