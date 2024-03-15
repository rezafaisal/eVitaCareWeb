@section('title')
    Dashboard
@endsection

@section('content')
    <section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        @if (Session::has('success'))
                <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
        @endif

        <div class="hero bg-primary text-white">
            <div class="hero-inner">
                <h2>Selamat datang!</h2>
                <p class="lead">Sebelum mulai, harap baca alur program home care kami dengan mengklik tombol di bawah.
                </p>
                <div class="mt-4">
                    <a href="#" class="btn btn-outline-white btn-lg">Alur Program Home Care</a>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection