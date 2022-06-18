<x-layout.Dashboard.main>
    <div class="container">
        <div x-data="{show: 'All'}">
            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill flex-column p-1" role="tablist">
                    <li @click="show = 'All'" class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#profile-tabs-simple" role="tab" aria-controls="profile" aria-selected="true">
                            All
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'Requested'" class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#profile-tabs-simple" role="tab" aria-controls="profile" aria-selected="true">
                            Requested
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'Refused'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                            Refused
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'Accepted'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                            Accepted
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'InComing'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                            InComing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'InLibya'"  class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                            InLibya
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'Arrived'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                            Arrived
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'No Response'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                            No Response
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'Not Accepted'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                            Not Accepted
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                            Archived
                        </a>
                    </li>
                </ul>
            </div>

            <div x-show="show == 'All'">
                <x-dashboard.orders-list order-name="All" :orders="$orders"/>
            </div>

            <div x-show="show == 'Requested'">
                <x-dashboard.orders-list order-name="Requested" :orders="$requestedOrders"/>
            </div>

            <div x-show="show == 'Refused'">
                <x-dashboard.orders-list order-name="Refused" :orders="$refusedOrders"/>
            </div>

            <div x-show="show == 'Accepted'">
                <x-dashboard.orders-list order-name="Accepted" :orders="$acceptedOrders"/>
            </div>

            <div x-show="show == 'InComing'">
                <x-dashboard.orders-list order-name="InComing" :orders="$inComingOrders"/>
            </div>

            <div x-show="show == 'InLibya'">
                <x-dashboard.orders-list order-name="InLibya" :orders="$inLibyaOrders"/>
            </div>

            <div x-show="show == 'Arrived'">
                <x-dashboard.orders-list order-name="Arrived" :orders="$arrivedOrders"/>
            </div>

            <div x-show="show == 'No Response'">
                <x-dashboard.orders-list order-name="No Response" :orders="$notResponseOrders"/>
            </div>

            <div x-show="show == 'Not Accepted'">
                <x-dashboard.orders-list order-name="Not Accepted" :orders="$notAcceptedOrders"/>
            </div>

        </div>
    </div>
</x-layout.Dashboard.main>
