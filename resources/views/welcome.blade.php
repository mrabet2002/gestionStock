<x-app-layout>
    @section('content') 
        <div class="containerc align-center">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="welcome-container">
                    <div class="flex align-center justify-center py-12 bg-gray-50 rounded-md">
                        <div class="welcome">
                            <h1>Bienvenu</h1>
                            <p>Lorem ipsum dolor sit amet Lorem ipsum .</p>
                            <form action="{{route('login')}}">
                                @csrf
                                <button type="submit" class="btn-indigo bg-indigo-500 text-white mt-3 py-2 px-4 rounded-md transition">
                                    Commancer
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="welcome-img">
                        <img width="100%" src="images/stock_vector.png" alt="">
                    </div>
                </div>
                
            </div>
        </div>
    @endsection
</x-app-layout>