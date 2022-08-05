<x-layout.main>

    @push('styles')
        <script src="https://cdn.tiny.cloud/1/rh5meoh1xys9dr39zl6kg1fys4e3lsd8il3bcfy42j7088ue/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    @endpush

    @push('scripts')
        <script>
            tinymce.init({
                selector: 'textarea#privacy_description',
                skin: 'bootstrap',
                plugins: 'lists, link, image, media',
                toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
                menubar: false,
                language: 'ar'
            });
        </script>
    @endpush

    <section>
        <div class="container p-5 ">
            <div lang="ar" style="direction: rtl" class="text-justify">
                {!! $privacy_description !!}
            </div>

        </div>
    </section>
    @auth()
        @if(auth()->user()->role == 'admin')
            <section x-data="{editMode: false}">
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <button @click="editMode = ! editMode" class="btn btn-dark">
                            <span x-text="editMode ? 'Collapse' : 'Edit'"></span>
                        </button>
                    </div>
                    <div x-show="editMode" class="my-5">
                        <h4>Edit Description</h4>
                        <form method="POST" action="{{ route('save-privacy-description') }}">
                            @csrf
                            <textarea class="w-100 form-control text-end" name="privacy_description" id="privacy_description" rows="10">{{ $privacy_description }}</textarea>
                            <input type="submit" class="btn btn-info mt-3" value="SAVE">
                        </form>
                    </div>
                </div>
            </section>
        @endif
    @endauth
</x-layout.main>
