// ================================
// HECOR PRODUCT CATALOG
// ================================

// Search functionality
const searchInput = document.getElementById("search");

if (searchInput) {
    searchInput.addEventListener("keyup", function () {
        const value = this.value.toLowerCase();
        const cards = document.querySelectorAll(".card");

        cards.forEach(card => {
            const text = card.innerText.toLowerCase();

            if (text.includes(value)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
}

// Category filtering
const filterButtons = document.querySelectorAll(".filters button");
const productSections = document.querySelectorAll(".product-section");

filterButtons.forEach(button => {

    button.addEventListener("click", () => {

        // Highlight active button
        filterButtons.forEach(btn => btn.classList.remove("active"));
        button.classList.add("active");

        const category = button.dataset.filter;

        productSections.forEach(section => {

            if (category === "all") {

                section.style.display = "block";

            } else {

                if (section.dataset.category === category) {
                    section.style.display = "block";
                } else {
                    section.style.display = "none";
                }

            }

        });

    });

});
// Back to Top
// Back to Top

const topBtn=document.getElementById("topBtn");

window.onscroll=function(){

if(document.body.scrollTop>300||document.documentElement.scrollTop>300){

topBtn.style.display="block";

}else{

topBtn.style.display="none";

}

};

topBtn.onclick=function(){

window.scrollTo({

top:0,

behavior:"smooth"

});

};