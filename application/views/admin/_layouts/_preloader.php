<div class="preloader">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" id="loader">
        <circle cx="50" cy="50" r="20" stroke-width="6" stroke="#3BB77E" stroke-dasharray="31.41592653589793 31.41592653589793" fill="none" stroke-linecap="round">
            <animateTransform attributeName="transform" type="rotate" dur="1.3513513513513513s" repeatCount="indefinite" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
        </circle>
        <circle cx="50" cy="50" r="13" stroke-width="6" stroke="#f8b26a" stroke-dasharray="20.420352248333657 20.420352248333657" stroke-dashoffset="20.420352248333657" fill="none" stroke-linecap="round">
            <animateTransform attributeName="transform" type="rotate" dur="1.3513513513513513s" repeatCount="indefinite" keyTimes="0;1" values="0 50 50;-360 50 50"></animateTransform>
        </circle>
    </svg>
</div>



<style>
    .preloader {
        position: fixed;
        height: 100%;
        width: 100%;
        background-color: #fff;
        z-index: 99999;
    }

    .preloader #loader {
        height: 80px;
        width: 80px;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        margin: auto;
        position: absolute;
    }
</style>