<x-layout.main>
    <section>
        <div class="container py-4 mt-6">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <form id="contactForm">

                        <!-- Name input -->
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control ps-3" id="name" type="text" placeholder="Name" />
                        </div>

                        <!-- Email address input -->
                        <div class="mb-3">
                            <label class="form-label" for="emailAddress">Email Address</label>
                            <input class="form-control ps-3" id="emailAddress" type="email" placeholder="Email Address" />
                        </div>

                        <!-- Message input -->
                        <div class="mb-3">
                            <label class="form-label" for="message">Message</label>
                            <textarea class="form-control ps-3" id="message" type="text" placeholder="Message" style="height: 10rem;"></textarea>
                        </div>

                        <!-- Form submit button -->
                        <div class="d-grid">
                            <button class="btn btn-dark btn-lg mt-3" type="submit">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout.main>
