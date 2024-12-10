
fbicon.addEventListener('mouseover', function() {
    fbicon.style.backgroundColor = 'blue';
    fbicon.style.color = 'black';

});



fbicon.addEventListener('mouseout', function() {
    fbicon.style.backgroundColor = '#C45946';
    fbicon.style.color = 'black';
});

const isicon = document.getElementById('isiconn');

isicon.addEventListener('mouseover', function() {
    isicon.style.backgroundColor = '#C13584';
    isicon.style.color = 'black';

});



isicon.addEventListener('mouseout', function() {
    isicon.style.backgroundColor = '#C45946';
    isicon.style.color = 'black';
});

const linkicon = document.getElementById('linkiconn');

linkicon.addEventListener('mouseover', function() {
    linkicon.style.backgroundColor = '#0A66C2';
    linkicon.style.color = 'black';

});

linkicon.addEventListener('mouseout', function() {
    linkicon.style.backgroundColor = '#C45946';
    linkicon.style.color = 'black';
});

const yticon = document.getElementById('yticonn');

yticon.addEventListener('mouseover', function() {
    yticon.style.backgroundColor = '#FF0000';
    yticon.style.color = 'black';

});

yticon.addEventListener('mouseout', function() {
    yticon.style.backgroundColor = '#C45946';
    yticon.style.color = 'black';
});




document.querySelectorAll(".question").forEach(question => {
    question.addEventListener("click", () => {
        const faqItem = question.parentElement;
        faqItem.classList.toggle("active");

        const answer = faqItem.querySelector(".answer");
        answer.style.display = answer.style.display === "block" ? "none" : "block";
    });
});




    document.getElementById('profileImage').addEventListener('click', function () {
        const slidingSection = document.getElementById('slidingSection');

      
        if (slidingSection.style.display === "none" || slidingSection.style.display === "") {
            slidingSection.style.display = "block";
        } else {
            slidingSection.style.display = "none";
        }
    });

