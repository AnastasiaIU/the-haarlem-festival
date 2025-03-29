<section id="scheduleMainContent" class="col-xxl-8 col-12 d-flex flex-column p-3 p-lg-5 gap-2">
    <div class="d-flex flex-column gap-3">
        <form method="post" class="tinymce-form">
            <h1 class="tinymce strolls-schedule-title h4 fw-bold"
                id="scheduleTitle" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h1>
            <input type="hidden" name="content" class="tinymce-input" data-field_id="scheduleTitle">
            <button type="submit" class="tinymce-save">Save</button>
        </form>
        <form method="post" class="tinymce-form">
            <h2 class="tinymce strolls-schedule-subtitle h5 fw-bold"
                id="scheduleSubtitle" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
            <input type="hidden" name="content" class="tinymce-input" data-field_id="scheduleSubtitle">
            <button type="submit" class="tinymce-save">Save</button>
        </form>
    </div>
    <div id="strollsSchedule" class="d-flex flex-column gap-5">
        <section class="schedule-card d-flex flex-column-reverse flex-md-row gap-4">
            <div class="date-container d-flex flex-column gap-3">
                <p class="h1 schedule-date fw-bold m-0"></p>
                <p class="schedule-day-of-week m-0"></p>
                <select class="form-select" aria-label="Select a time"></select>
            </div>
            <div class="book-container d-flex flex-column flex-grow-1 pe-lg-2 gap-3">
                <form method="post" class="tinymce-form-guides">
                    <p class="tinymce-guides guide-name h4 fw-bold m-0" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                    <input type="hidden" name="content" class="tinymce-input">
                    <button type="submit" class="tinymce-save">Save</button>
                </form>
                <p class="language m-0"></p>
                <div>
                    <button class="btn btn-primary font-p-16 fw-bold py-2 px-3">Book now</button>
                </div>
            </div>
            <div class="col-md-3 guide-image-container">
                <img class="guide-image" src="" alt="">
                <button class="change-image-guides">Change Image</button>
                <input class="d-none" type="file" accept="image/*">
            </div>
            <div class="col-md-3 guide-text-container my-auto">
                <form method="post" class="tinymce-form-guides">
                    <p class="tinymce-guides guide-text text-center m-0" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                    <input type="hidden" name="content" class="tinymce-input">
                    <button type="submit" class="tinymce-save">Save</button>
                </form>
            </div>
        </section>
    </div>
</section>