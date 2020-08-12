<?php
/**
 * @var \App\Models\Business $business
 * @var \App\Models\Procedure $prcedure
 */
?>
<footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
        <div class="col-12 col-md text-center">
            <img class="mb-2" src="/favicon.ico" alt="" width="50" height="50"><br/>
            Powered by <br/>
            <b><a href="#">ServiceTime</a></b>
        </div>

        <div class="col-6 col-md">
            <h5>Contact Us</h5>

            @isset($business->address)
                <ul class="list-unstyled text-small">
                    <li class="mb-3">{{ $business->address->address }}</li>

                    @foreach($business->address->contacts as $contact)
                        <li>{{ $contact->contact }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>

        <div class="col-6 col-md">
            <h5>Resources</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="#">Resource</a></li>
                <li><a class="text-muted" href="#">Resource name</a></li>
                <li><a class="text-muted" href="#">Another resource</a></li>
                <li><a class="text-muted" href="#">Final resource</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="#">Team</a></li>
                <li><a class="text-muted" href="#">Locations</a></li>
                <li><a class="text-muted" href="#">Privacy</a></li>
                <li><a class="text-muted" href="#">Terms</a></li>
            </ul>
        </div>
    </div>
</footer>
