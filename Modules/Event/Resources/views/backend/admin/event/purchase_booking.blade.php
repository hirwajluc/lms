@extends('backend.master')
@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    <div class="page-content">
        {{-- breadecrumb Area S t a r t --}}
        @include('backend.ui-components.breadcrumb', [
            'title' => @$data['title'],
            'routes' => [
                route('dashboard') => ___('common.Dashboard'),
                '#' => @$data['title'],
            ],
            'buttons' => 1,
        ])
        {{-- breadecrumb Area E n d --}}
        <!--  table content start -->
        <div class="table-content table-basic ecommerce-components product-list">
            <div class="card">
                <div class="card-body">
                    <!--  toolbar table start  -->
                    <div class="table-toolbar d-flex flex-wrap gap-2 flex-column flex-xl-row justify-content-center justify-content-xxl-between align-content-center pb-3">
                        <form action="" method="get">
                            <div class="align-self-center">
                                <div
                                    class="d-flex flex-wrap gap-2 flex-column flex-lg-row justify-content-center align-content-center">
                                    <!-- show per page -->
                                    @include('backend.ui-components.per-page')
                                    <!-- show per page end -->

                                    <div class="align-self-center d-flex gap-2">
                                        <!-- search start -->
                                        <div class="align-self-center">
                                            <div class="search-box d-flex">
                                                <input class="form-control" placeholder="{{ ___('common.search') }}"
                                                    name="search" value="{{ @$_GET['search'] }}" />
                                                <span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                                            </div>
                                        </div>
                                        <!-- search end -->
                                        <!-- dropdown action -->
                                        <div class="align-self-center">
                                            <div class="dropdown dropdown-action" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Filter">
                                                <button type="submit" class="btn-add">
                                                    <span class="icon">{{ ___('common.Filter') }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- add btn end -->
                    </div>
                    <!--toolbar table end -->
                    <!--  table start -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead">
                                <!-- start table header from ui-helper function -->
                                {{ table_header('', $data['tableHeader']) }}
                                <!-- end table header from ui-helper function -->
                            </thead>
                            <tbody class="tbody">
                                @forelse ($data['event'] as $key => $event)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Str::limit(@$event->title, 20) }}</td>
                                        <td>{{ @$event->event_type }}</td>
                                        <td>{{ @$event->category->title }}</td>
                                        <td>{{ @$event->isPaid() }}</td>
                                        <td class="create-date">{{ showDate(@$event->start) }} - {{ showDate(@$event->end) }}</td>
                                        <td>{{ @$event->user->name }}</td>
                                        <td>
                                            {{ statusBackend(@$event->visibleStatus->class, $event->visibleStatus->name) }}
                                        </td>
                                        <td>
                                            {{ statusBackend(@$event->status->class, $event->status->name) }}
                                        </td>
                                        <td class="action">
                                            <div class="dropdown dropdown-action">
                                                <button type="button" class="btn-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('event.admin.purchase_booking.participants', encryptFunction($event->id)) }}">
                                                            <span class="icon mr-12">
                                                                <i class="fa-solid fa-users"></i>
                                                            </span> {{ ___('common.Participants') }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- empty table -->
                                    @include('backend.ui-components.empty_table', [
                                        'colspan' => '9',
                                        'message' => ___(
                                            'message.Please add a new entity or manage the data table to see the content here'),
                                    ])
                                    <!-- empty table -->
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!--  table end -->
                    <!--  pagination start -->
                    @include('backend.ui-components.pagination', ['data' => $data['event']])
                    <!--  pagination end -->
                </div>
            </div>
        </div>
        <!--  table content end -->
    </div>
@endsection
@push('script')
    @include('backend.partials.delete-ajax')
@endpush
