<main class="container-fluid d-flex flex-column flex-grow-1 align-items-center p-0">
    <section class="banner col-12 col-md-6 col-lg-5 col-xl-4"> 
        <div>
            <img src="" alt="Homepage Banner" id="homepageBanner" class="img-fluid">
        </div>
    </section>
    
    <section class="row">
    <div class="col-12 col-md-6 col-lg-5 col-xl-4 ">
        <div class="oval-container position-relative text-center">
            <img src="/assets/images/oval_shape_event.svg" class="img-fluid oval-image" alt="Oval">
            <div class="oval-text-overlay position-absolute top-50 start-50 translate-middle text-center w-100">
                <h1 class="display-5 fw-bold mb-2"></h1>
                <p class="lead w-100 w-md-75 mx-auto"></p>
            </div>
        </div>
    </div>
    </section>
    <section class="museum-section col-12 col-md-6 col-lg-5 col-xl-4 position-relative">
        <div class="museum-banner position-relative">
            <img src="" class="img-fluid" alt="Museum">     
        </div>
        <div class="museum-shape position-absolute left-0">
            <img src="/assets/images/teylers_home_shape.svg" class="img-fluid" alt="Green Shape">
            <div class="text-overlay position-absolute translate-middle text-white text-left px-3 col-12 col-md-6 col-lg-5 col-xl-4">
                <h2 class="h2 fw-bold text-white"></h2>
                <p class="h5 text-white"></p>
                <div class="d-flex gap-2 flex-wrap justify-content-md-left">
                    <a href="" class="btn btn-primary h5 " data-button-id="1"></a>
                    <a href="#map-section" class="btn btn-primary h5"></a>
                </div>
                <div class="download-section d-flex align-items-center gap-2">
                    <?php include __DIR__ . '/events/teylers/app_promotion_hero.php'; ?>
                </div>
            </div>
        </div>
        <div class="yellow-shape position-absolute left-0">
            <img src="/assets/images/yellow_shape.svg" class="img-fluid" alt="Yellow Shape">
        </div>
    </section>
    <section class="yummy-section col-12 col-md-6 col-lg-5 col-xl-4 position-relative">
        <div class="yummy-banner position-relative">
            <img src="" class="img-fluid" alt="Yummy">     
        </div>
        <div class="yummy-shape position-absolute top-0">
            <img src="/assets/images/yummy_home_shape.svg" class="img-fluid" alt="Terracota Shape">
            <div class="text-overlay position-absolute text-white text-left px-3 col-12 col-sm-10 col-md-8">
                <h2 class="h2 fw-bold text-white"></h2>
                <p class="h5 text-white"></p>
                <div class="d-flex gap-2 flex-wrap justify-content-left">
                    <a href="" class="btn btn-primary p-2 h5" data-button-id="2" role="button"></a>
                    <a href="#map-section" class="btn btn-primary p-2 h5" role="button"></a>
                </div>
            </div>
        </div>
    </section>
    <section class="strolls-section col-12 col-md-6 col-lg-5 col-xl-4 position-relative">
        <div class="strolls-banner position-relative">
            <img src="" class="img-fluid" alt="Strolls">     
        </div>
        <div class="strolls-shape position-absolute top-0">
            <img src="/assets/images/history_strolls_home_shape.svg" class="img-fluid" alt="Punch Shape">
            <div class="text-overlay position-absolute translate-middle text-white text-left px-3 col-12 col-sm-10 col-md-8">
                <h2 class="h2 fw-bold text-white"></h2>
                <p class="h5 text-white"></p>
                <div class="d-flex gap-2 flex-wrap justify-content-left">
                    <a href="" class="btn btn-primary p-2 h5" data-button-id="3" role="button"></a>
                    <a href="#map-section" class="btn btn-primary p-2 h5" role="button"></a>
                </div>
        </div>
    </section>
    <section class="dance-section col-12 col-md-6 col-lg-5 col-xl-4 position-relative">
        <div class="dance-banner position-relative">
            <img src="" class="img-fluid" alt="Dance">     
        </div>
        <div class="dance-shape position-absolute">
            <img src="/assets/images/dance_home_shape.svg" class="img-fluid" alt="Blue Shape">
        <div class="text-overlay position-absolute translate-middle text-white text-left px-3 col-12 col-sm-10 col-md-8">
            <h2 class="h2 fw-bold text-white"></h2>
            <p class="h5 text-white"></p>
            <div class="d-flex gap-2 flex-wrap justify-content-left">
                <a href="" class="btn btn-primary p-2 h5" data-button-id="4" role="button"></a>
                <a href="#map-section" class="btn btn-primary p-2 h5" role="button"></a>
            </div>
        </div>
        </div>
    </section>
    <section class="schedule-section col-12 col-md-6 col-lg-5 col-xl-4 position-relative p-4 m-4">
        <div class="schedule-shape">
            <img src="/assets/images/schedule-shape.svg" class="img-fluid" alt="Schedule Shape">
        </div>
        
        <div class="schedule-content py-5">
            <div class="schedule-title">
                <h2 class="h1 fw-bold custom_schedule_title"></h2>
                <p class="h2 fw-bold custom_schedule_subtitle"></p>
            </div>
            <div class="schedule"></div>
        </div>
    </section>
    <section id="map-section" class="location-section col-12 col-md-6 col-lg-5 col-xl-4 position-relative ">
        <div class="location-title">
            <img src="/assets/images/location-icon.svg" class="img-fluid" alt="Location Icon">
            <h2>LOCATIONS</h2>
        </div>  
        <iframe src="https://www.google.com/maps/d/embed?mid=1kYks-RDNNXXlRf26fyN1YrX8RR75pZ0&ehbc=2E312F" class = "homepage-map">
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
        
    </section>
</main>