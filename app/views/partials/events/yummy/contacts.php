<section id="contactDetails" class="d-inline-flex flex-column">
    <div class="d-flex flex-column">
        <h2 class="contact-header h4 fw-bold mb-3">Contacts</h2>
        <p id="restaurantAddress"><span>Address: </span><a target="_blank"></a></p>
        <p id="restaurantPhone"><span>Phone: </span><a target="_blank"></a></p>
        <p id="restaurantEmail"><span>Email: </span><a target="_blank"></a></p>
    </div>
    <div class="d-flex gap-4">
        <a id="restaurantFacebook" target="_blank">
            <img src="../../assets/images/facebook_terracotta.svg" alt="Facebook Icon" class="img-fluid icon-32">
        </a>
        <a id="restaurantInstagram" target="_blank">
            <img src="../../assets/images/instagram_terracotta.svg" alt="Instagram Icon" class="img-fluid icon-32">
        </a>
    </div>
    <div class="d-flex flex-column pt-4">
        <form method="post" class="tinymce-form">
            <h3 class="tinymce h5 fw-bold mb-4"
                id="contactFormTitle" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h3>
            <input type="hidden" name="content" class="tinymce-input" data-field_id="contactFormTitle">
            <button type="submit" class="tinymce-save">Save</button>
        </form>
        <form id="contactForm" class="needs-validation" novalidate>
            <div class="d-flex flex-column gap-3 mb-2">
                <div class="form-group d-flex flex-column flex-md-row gap-1 gap-md-3">
                    <label class="form-label text-nowrap col-2" for="inputName">Name: *</label>
                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter your name"
                           required>
                    <div class="invalid-feedback" id="inputNamePrompt">Please, provide your name.</div>
                </div>
                <div class="form-group d-flex  flex-column flex-md-row gap-1 gap-md-3">
                    <label class="form-label text-nowrap col-2" for="inputEmail">Email: *</label>
                    <input type="email" name="email" class="form-control" id="inputEmail"
                           placeholder="Enter your email" required>
                    <div class="invalid-feedback" id="inputEmailPrompt">Please, provide your email.</div>
                </div>
                <div class="form-group d-flex flex-column flex-md-row gap-1 gap-md-3">
                    <label class="form-label text-nowrap col-2" for="inputPhone">Phone: </label>
                    <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="Enter your phone">
                </div>
                <div class="form-group d-flex flex-column flex-md-row gap-1 gap-md-3">
                    <label class="form-label text-nowrap col-2" for="inputMessage">Message: *</label>
                    <textarea name="email" class="form-control" id="inputMessage" placeholder="Enter your message"
                              rows="3" required></textarea>
                    <div class="invalid-feedback" id="inputMessagePrompt">Please, provide your message.</div>
                </div>
                <div class="d-flex gap-0 gap-md-3">
                    <div class="col-0 col-md-2"></div>
                    <button id="sendContactForm" type="submit" class="btn btn-primary">Send</button>
                </div>
            </div>
        </form>
    </div>
</section>
