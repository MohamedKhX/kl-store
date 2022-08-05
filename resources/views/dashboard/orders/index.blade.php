<x-layout.Dashboard.main>
    <div class="container">
        <div x-data="{show: 'All'}">
            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill flex-column p-1" role="tablist">
                    <li @click="show = 'All'" class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="" role="tab" aria-controls="profile" aria-selected="true">
                            All
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'Requested'" class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="" role="tab" aria-controls="profile" aria-selected="true">
                            Requested
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'Refused'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="" role="tab" aria-controls="dashboard" aria-selected="false">
                            Refused
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'Accepted'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="" role="tab" aria-controls="dashboard" aria-selected="false">
                            Accepted
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'InComing'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="" role="tab" aria-controls="dashboard" aria-selected="false">
                            InComing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'InLibya'"  class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="" role="tab" aria-controls="dashboard" aria-selected="false">
                            InLibya
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'Arrived'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="" role="tab" aria-controls="dashboard" aria-selected="false">
                            Arrived
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'No Response'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="" role="tab" aria-controls="dashboard" aria-selected="false">
                            No Response
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'Not Accepted'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="" role="tab" aria-controls="dashboard" aria-selected="false">
                            Not Accepted
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click="show = 'Archived'" class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="" role="tab" aria-controls="dashboard" aria-selected="false">
                            Archived
                        </a>
                    </li>
                </ul>
            </div>

            <div x-show="show == 'All'">
                <livewire:orders-list orders-name="All"/>
            </div>

            <div x-show="show == 'Requested'">
                <livewire:orders-list orders-name="Requested"/>
            </div>

            <div x-show="show == 'Refused'">
                <livewire:orders-list orders-name="Refused"/>
            </div>

            <div x-show="show == 'Accepted'">
                <livewire:orders-list orders-name="Accepted"/>
            </div>

            <div x-show="show == 'InComing'">
                <livewire:orders-list orders-name="InComing"/>
            </div>

            <div x-show="show == 'InLibya'">
                <livewire:orders-list orders-name="InLibya"/>
            </div>

            <div x-show="show == 'Arrived'">
                <livewire:orders-list orders-name="Arrived"/>
            </div>

            <div x-show="show == 'No Response'">
                <livewire:orders-list orders-name="No Response"/>
            </div>

            <div x-show="show == 'Not Accepted'">
                <livewire:orders-list orders-name="Not Accepted"/>
            </div>

            <div x-show="show == 'Archived'">
                <livewire:orders-list orders-name="Archived" archived="true"/>
            </div>

        </div>
    </div>
</x-layout.Dashboard.main>
