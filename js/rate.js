const submitBtn = document.querySelector(".submit");
const closeFeedback = document.querySelector(".close-btn .fas");
const feedbackBox = document.querySelector(".feedback-user");
const username = document.getElementById("name");
const feedback = document.getElementById("feedback");
const starDiv = feedbackBox.querySelector(".stars");
const writeBtn = document.querySelector(".btn-write");
const reviewContent = document.querySelector(".review-content")

//rating default 5 star when user not click

let userRatingStar = 5;
const numberStar = 5;

//initialize rating object

let ratingStars = {

    numRatings: 0, //number of rating
    avgRating: 0, //average of rating

};

//use for update time of feedback

let timeouts = [];

//initialize number of star (numero de estrellas)


Array.from({length:numberStar}, (_,i) => {

    let number = ++i; //1,2,3,4,5

    ratingStars[`${number}stars`] = 0;

})


// set default value

setDefaultRating();

//set rating when page loaded

calcRating();

//show/hide feedback

writeBtn.addEventListener("click",() => {

    feedbackBox.classList.add("show")

})

closeFeedback.addEventListener("click", setDefaultRating);

//submit feedback

/* submitBtn.addEventListener("click", () => {

    if(username.value !== '' && feedback.value !== ''){

        const options ={

            timeZone: 'Asia/Ho_Chi_Minh',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',

        }

        let time = new Date().toLocaleString('en-US', options);
        console.log(time);

        reviewContent.insertAdjacentHTML('afterbegin',`
    
        <div class="user-review">
    
                            <div class="user-rating">
    
                                <div class="username">${username.value}</div>
    
                                <div class="stars">
    
                                    ${setStars(userRatingStar)}
    
                                </div>
    
                            </div>
    
                            <!-- end user rating -->
    
                            <div class="comment-content">
    
                                ${feedback.value}
    
                            </div>
    
                            <time datetime="${time}" title="${time}">Just ahora</time>
    
                        </div>

        `);

        //when success

        ratingStars[`${userRatingStar}stars`]++;
        ratingStars.numRatings++;

        calcRating();


        console.log(ratingStars);

        //update time for feedback

        for(let time of timeouts){

            clearInterval(time);

        }

        timeouts = []; //reset

        //update time for feedback

        updateTimeAgo(); //update again time for comment


        //set default value when submit success

        setDefaultRating();

    }

}) */

function setDefaultRating(){

    feedbackBox.classList.remove("show");

    username.value = '';

    feedback.value = '';

    userRatingStar = 5;

    starDiv.innerHTML = "";


    /* Array.from({length:numberStar}, (_,i) => {

        let number = ++i; //1,2,3,4,5

        //create element star

        const starEle = document.createElement("i");

        starEle.classList.add("fas","fa-star","fa-fw");

        starEle.dataset.rating = number;

        starEle.addEventListener("click", () => {

            handleRating(number);

        })

        starDiv.appendChild(starEle);

    }) */

}

/* function handleRating(number){

    const stars = feedbackBox.querySelectorAll(".stars i");

    userRatingStar = number;

    console.log(userRatingStar);

    stars.forEach(star => {

        if(number < star.dataset.rating){

            star.classList.remove("fas");
            star.classList.add("far");

        }else{

            star.classList.add("fas")
            star.classList.remove("far")

        }

    })

} */

function setStars(number){

    let stars = '';

    Array.from({length:numberStar},(_,i) => {

        let starNth = 0;
        starNth = ++i;
        stars += `${

            number >= starNth ? "<i class='fas fa-fw fa-star'></i>"
            : number >= starNth - 0.5 ? "<i class='fas fa-fw fa-star-half'></i>"
            : "<i class='far fa-fw fa-star'></i>"

        }`

    })

    return stars;

}

function time_seconds(time){

    let current = new Date().toLocaleDateString('en-US', {

        timeZone: 'Asia/Ho_Chi_Minh',

    });

    let cur_time = Date.parse(current); //ms

    let time_ago = Date.parse(time); //ms

    let time_elapsed = (cur_time - time_ago) / 1000; //seconds

    return time_elapsed;

}

function time_elapsed_string(time){

    let time_elapsed = time_seconds(time);

    let seconds = time_elapsed;
    let minutes = Math.floor(time_elapsed / 60);
    let hours = Math.floor(time_elapsed / 3600)
    let days = Math.floor(time_elapsed / 86400)
    let weeks = Math.floor(time_elapsed / 604800)
    let months = Math.floor(time_elapsed / (3600 * 24 * 30));
    let years = Math.floor(time_elapsed / (3600 * 24 * 365));


    if (seconds < 60){

        return 'Justo ahora';

    }else if (minutes < 60){

        console.log('minutes', minutes);
        if (minutes == 1) return '1 minute ago';
        else return `${minutes} minutes ago`;

    }else if (hours < 24){

        if (hours == 1) return 'an hour ago';
        else return `${hours} hours ago`;

    }else if (days < 7){

        if (days == 1) return 'yesterday';
        else return `${days} days ago`;

    }else if (weeks < 4.3){

        if (weeks == 1) return 'a week ago';
        else return `${weeks} weeks ago`;

    }else if (months < 12){

        if (months == 1) return 'a month ago';
        else return `${months} months ago`;

    }else{

        if(years == 1) return 'one year ago';
        else return `${years} years ago`;

    }

}

function updateTimeAgo(){

    const datetimeEle = document.querySelectorAll('time [datetime]');

    datetimeEle.forEach((time) => {

        const datetime = time.getAttribute('datetime');

        setTimeAgo(time, datetime)

        const timeSeconds = time_seconds(datetime);

        console.log(timeSeconds);

        let hours = timeSeconds / 3600;

        if(hours >= 1){

            setInterval(() => {
                setTimeAgo(time, datetime)
            }, 60 * 1000 * 60); //update after one hour

        }else{

            setInterval(() => {
                setTimeAgo(time, datetime)
            }, 60 * 1000 ); //update after one minute

        }

    });


}

function setTimeAgo(ele, datetime){

    const timeAgo = time_elapsed_string(datetime);
    ele.textContent = timeAgo;

}

function calcRating(){

    let sumStars = 0;
    let indexProgress = 0;

    const barItems = document.querySelectorAll('.rating-bar .bar-item');

    /* for(let number = numberStar; number>=1;number--){

        let percent = 0;

        const numberOfStars = ratingStars[`${number}stars`];

        if(numberOfStars){

            sumStars += number * numberOfStars;
            percent = ((numberOfStars / ratingStars.numRatings) * 100).toFixed(1)

        }

        barItems[indexProgress].querySelector('.progress-line').style.width = `${percent}%`;
        barItems[indexProgress].querySelector('.percent').textContent = `${percent}%`;

        indexProgress++;


    } */

    if(ratingStars.numRatings){

        ratingStars.avgRating = (sumStars / ratingStars.numRatings).toFixed(1);
    }

    /* document.querySelector('.count-review span').textContent = ratingStars.numRatings; */
    /* document.querySelector('.rating-count .count').textContent = ratingStars.numRatings; */
    /* document.querySelector('.star-count .avg').textContent = ratingStars.avgRating; */
    document.querySelector(".avg-stars").innerHTML = setStars(ratingStars.avgRating);
    $.ajax({
        method: 'post',
        url: '../secciones/restaurante.php',
        data: ratingStars,
        success: function(response) {
        console.log(ratingStars);
        
        }
        });
    

    console.log(ratingStars);
    /* console.log(sumStars); */

}