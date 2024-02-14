<!-- header-->
@include('layout.header');

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li>Products</li>
            </ol>
            <h2>Products</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">


            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{ $message }}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif


            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">
                                {{ ($products->currentpage() - 1) * $products->perpage() + $loop->index + 1 }}
                            </th>
                            <td>{{ ucfirst($product->name) }}</td>
                            <td>{{ $product->price }}</td>
                            <td><a href="{{ route('product.view', encrypt($product->id))}}" class="btn btn-success">Buy</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div>
                {{ $products->links() }}
            </div>

        </div>
    </section>

</main><!-- End #main -->

@include('layout.footer');
