<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>

    <div>
        <center>
            
                <p style="font-size: 11px; margin-top: 20px; text-decoration: underline;">
                    <a href="{{ route('simulasi') }}" style="color: grey; text-decoration: none;" target="_blank">Go to Simulasi Kredit</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="https://yamahabismagroup.com/games" style="color: grey; text-decoration: none;" target="_blank">Play Games!</a>
                </p>

            <a href="https://www.linkedin.com/in/iwayanandika" style="color: grey; text-decoration: none;" target="_blank">
                <p style="font-size: 11px; margin-top: 20px;">
                    &copy;CRM Bisma Group
                </p>
                <p style="font-size: 11px;">
                    Developed by <span style="color: #0677d4;"> Andika Pranayoga </span>
                </p>
            </a>
        </center>
    </div>
</div>