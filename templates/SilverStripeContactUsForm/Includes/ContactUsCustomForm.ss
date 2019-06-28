<form
    id="ContactUsForm_ContactUsForm"
    action="/$URLSegment/ContactUsForm/"
    method="post"
    enctype="application/x-www-form-urlencoded"
>
    <p
        id="ContactUsForm_ContactUsForm_error"
        class="message "
        style="display: none"
    ></p>
	ContactUsForm_includes
    <fieldset>
        <div
            id="ContactUsForm_ContactUsForm_FirstName_Holder"
            class="field text"
        >
            <label class="left" for="ContactUsForm_ContactUsForm_FirstName"
                >First Name</label
            >
            <div class="middleColumn">
                <input
                    type="text"
                    name="FirstName"
                    class="form-control"
                    id="ContactUsForm_ContactUsForm_FirstName"
                    required="required"
                    aria-required="true"
                />
            </div>
        </div>

        <div
            id="ContactUsForm_ContactUsForm_LastName_Holder"
            class="field text"
        >
            <label class="left" for="ContactUsForm_ContactUsForm_LastName"
                >Last Name</label
            >
            <div class="middleColumn">
                <input
                    type="text"
                    name="LastName"
                    class="form-control"
                    id="ContactUsForm_ContactUsForm_LastName"
                />
            </div>
        </div>

        <div
            id="ContactUsForm_ContactUsForm_Email_Holder"
            class="field email text"
        >
            <label class="left" for="ContactUsForm_ContactUsForm_Email"
                >Email</label
            >
            <div class="middleColumn">
                <input
                    type="email"
                    name="Email"
                    class="form-control"
                    id="ContactUsForm_ContactUsForm_Email"
                    required="required"
                />
            </div>
        </div>

        <div id="ContactUsForm_ContactUsForm_Phone_Holder" class="field text">
            <label class="left" for="ContactUsForm_ContactUsForm_Phone"
                >Phone</label
            >
            <div class="middleColumn">
                <input
                    type="text"
                    name="Phone"
                    class="form-control"
                    id="ContactUsForm_ContactUsForm_Phone"
                    placeholder="Your Phone number"
                />
            </div>
        </div>

        <div id="ContactUsForm_ContactUsForm_Address_Holder" class="field text">
            <label class="left" for="ContactUsForm_ContactUsForm_Address"
                >Address</label
            >
            <div class="middleColumn">
                <input
                    type="text"
                    name="Address"
                    class="form-control"
                    id="ContactUsForm_ContactUsForm_Address"
                />
            </div>
        </div>

        <div
            id="ContactUsForm_ContactUsForm_CompanyName_Holder"
            class="field text"
        >
            <label class="left" for="ContactUsForm_ContactUsForm_CompanyName"
                >Company Name</label
            >
            <div class="middleColumn">
                <input
                    type="text"
                    name="CompanyName"
                    class="form-control"
                    id="ContactUsForm_ContactUsForm_CompanyName"
                />
            </div>
        </div>

        <div id="ContactUsForm_ContactUsForm_Website_Holder" class="field text">
            <label class="left" for="ContactUsForm_ContactUsForm_Website"
                >Website</label
            >
            <div class="middleColumn">
                <input
                    type="text"
                    name="Website"
                    class="form-control"
                    id="ContactUsForm_ContactUsForm_Website"
                />
            </div>
        </div>

        <div
            id="ContactUsForm_ContactUsForm_Message_Holder"
            class="field textarea"
        >
            <label class="left" for="ContactUsForm_ContactUsForm_Message"
                >Message</label
            >
            <div class="middleColumn">
                <textarea
                    name="Message"
                    class="form-control"
                    id="ContactUsForm_ContactUsForm_Message"
                    placeholder="Your Message for us"
                    required="required"
                    minlength="6"
                    rows="8"
                    cols="20"
                ></textarea>
            </div>
        </div>

        <input
            type="hidden"
            name="FromPageTitle"
            value="New Page with Contact Us Form"
            class="hidden"
            id="ContactUsForm_ContactUsForm_FromPageTitle"
        />

        <input
            type="hidden"
            name="Locale"
            class="hidden"
            id="ContactUsForm_ContactUsForm_Locale"
        />

        <input
            type="hidden"
            name="ip"
            value="a23cbab890b339525c930d123618940c66a489a6"
            class="hidden"
            id="ContactUsForm_ContactUsForm_SecurityID"
        />

        <div class="clear"><!-- --></div>
    </fieldset>

    <div class="btn-toolbar">
        <button
            type="submit"
            name="action_SaveFormData"
            value="Submit"
            class="btn btn-primary mt-2 btn-submit"
            id="ContactUsForm_ContactUsForm_action_SaveFormData"
        >
            <span>Submit</span>
        </button>
    </div>
</form>
