<section id="teylersMainContent" class="d-flex flex-column flex-grow-1 w-100 p-0 align-items-center">
    <section id="teylersLorentz" class="d-flex w-100">
        <div class="lorentz-shadow"></div>
        <div class="col-12 col-lg-6 d-flex flex-column p-5 my-5 gap-3">
            <form method="post" class="tinymce-form">
                <h2 id="lorentzTitle" class="tinymce h1 mb-3" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="lorentzTitle">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <form method="post" class="tinymce-form">
                <p id="lorentzSubtitle" class="tinymce text-white m-0" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="lorentzSubtitle">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <form method="post" class="tinymce-form">
                <p id="lorentzDescription" class="tinymce text-white mb-4" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="lorentzDescription">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <div class="card d-inline-flex">
                <div class="card-header text-white fw-bold">Schedule</div>
                <div class="card-body d-flex gap-2">
                    <div>
                        <select id="lorentzDate" class="form-select" aria-label="Select a day">
                            <option value="" disabled="" selected="">Select a day</option>
                            <option value="25">Friday, July 25th</option>
                            <option value="26">Saturday, July 26th</option>
                            <option value="27">Sunday, July 27th</option>
                        </select>
                    </div>
                    <div>
                        <select id="lorentzTime" class="form-select" aria-label="Select a time">
                            <option value="" disabled="" selected="">Select a time</option>
                            <option value="12:30">12:30 - 13:20</option>
                            <option value="14:00">14:00 - 14:50</option>
                            <option value="15:00">15:00 - 15:50</option>
                        </select>
                    </div>
                    <button id="lorentzButton" class="btn btn-primary text-nowrap py-2 px-3" disabled>Plan to visit
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section id="appPromotion" class="d-flex flex-column gap-4 gap-lg-5 w-100 justify-content-center p-3 p-lg-5 pt-5">
        <div class="d-flex flex-wrap gap-4 gap-lg-5 pt-3 w-100 justify-content-center">
            <div class="promotion-card col-lg-5 d-flex flex-column flex-grow-1 p-3 p-lg-5 justify-content-center">
                <div class="d-flex flex-column gap-3">
                    <form method="post" class="tinymce-form">
                        <h2 id="discoverAppTitle" class="tinymce h1 text-white fw-bold m-3 ms-0" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
                        <input type="hidden" name="content" class="tinymce-input" data-field_id="discoverAppTitle">
                        <button type="submit" class="tinymce-save">Save</button>
                    </form>
                    <div class="app-description d-inline-flex">
                        <form method="post" class="tinymce-form">
                            <p id="discoverAppDescription" class="tinymce text-white m-0" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                            <input type="hidden" name="content" class="tinymce-input" data-field_id="discoverAppDescription">
                            <button type="submit" class="tinymce-save">Save</button>
                        </form>
                    </div>
                    <div class="app-badges d-flex flex-wrap gap-3">
                        <a href="https://play.google.com/store" target="_blank">
                            <img class="app-badge"
                                 src="/assets/images/GetItOnGooglePlay_Badge_Web_color_English.png"
                                 alt="Get it on Google Play"/>
                        </a>
                        <a href="https://www.apple.com/app-store/" target="_blank">
                            <img class="app-badge"
                                 src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                                 alt="Download on the App Store"/>
                        </a>
                    </div>
                </div>
            </div>
            <div class="promotion-card col-lg-5 d-flex flex-column flex-grow-1">
                <div class="p-3 p-lg-5">
                    <form method="post" class="tinymce-form">
                        <h2 id="teylerTitle" class="tinymce h1 text-white fw-bold mb-4" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
                        <input type="hidden" name="content" class="tinymce-input" data-field_id="teylerTitle">
                        <button type="submit" class="tinymce-save">Save</button>
                    </form>
                    <form method="post" class="tinymce-form">
                        <p id="teylerDescription" class="tinymce text-white mb-4" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                        <input type="hidden" name="content" class="tinymce-input" data-field_id="teylerDescription">
                        <button type="submit" class="tinymce-save">Save</button>
                    </form>
                    <div class="teyler-schedule">
                        <div class="card d-inline-flex">
                            <div class="card-header text-white fw-bold">Schedule</div>
                            <div class="card-body bg-white d-flex gap-3">
                                <div>
                                    <select id="teylerDate" class="form-select" aria-label="Select a day">
                                        <option value="" disabled="" selected="">Select a day</option>
                                        <option value="24">Thursday, July 24th</option>
                                        <option value="25">Friday, July 25th</option>
                                        <option value="26">Saturday, July 26th</option>
                                        <option value="27">Sunday, July 27th</option>
                                    </select>
                                </div>
                                <div>
                                    <p class="m-0">10:00 - 17:00</p>
                                </div>
                                <button id="teylerButton" class="btn btn-primary text-nowrap py-2 px-3" disabled>
                                    Plan to
                                    visit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="justify-content-center d-flex image-container">
                    <img id="appPromotionImage1" src="" alt="">
                    <button class="change-image" id="appPromotionImage1Button">Change Image</button>
                    <input class="d-none" type="file" accept="image/*" data-button="appPromotionImage1Button">
                </div>
            </div>
        </div>
        <div class="promotion-card d-flex flex-column w-100">
            <div class="p-3 p-lg-5">
                <form method="post" class="tinymce-form">
                    <h2 id="scanAppTitle" class="tinymce h1 text-white text-center fw-bold mb-2" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
                    <input type="hidden" name="content" class="tinymce-input" data-field_id="scanAppTitle">
                    <button type="submit" class="tinymce-save">Save</button>
                </form>
            </div>
            <div class="justify-content-center d-flex mx-3 image-container">
                <img id="appPromotionImage2" src="" alt="">
                <button class="change-image" id="appPromotionImage2Button">Change Image</button>
                <input class="d-none" type="file" accept="image/*" data-button="appPromotionImage2Button">
            </div>
        </div>
    </section>
    <section class="col-12 col-xxl-8 d-flex px-3 pb-3 px-lg-5 pb-lg-5">
        <div class="event-map col-xxl-8 d-flex flex-column m-0">
            <div class="d-flex gap-2 pb-2">
                <img class="location-icon" src="/assets/images/location-icon.svg" alt="Location icon">
                <h2 class="locations-header h4 fw-bold">Locations</h2>
            </div>
            <iframe
                    style="border:0"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    width="100%"
                    height="100%"
                    src="https://www.google.com/maps/d/u/0/embed?mid=1bBrDyte8YUKF8Jur3lJ-Ponmdeg66p8&ehbc=D43D25&noprof=1">
            </iframe>
        </div>
    </section>
</section>