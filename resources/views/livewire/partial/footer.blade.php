<!-- resources/views/livewire/printing-footer.blade.php -->
<footer class="relative overflow-hidden text-white bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="30" cy="30" r="2"/><circle cx="10" cy="10" r="1"/><circle cx="50" cy="10" r="1"/><circle cx="10" cy="50" r="1"/><circle cx="50" cy="50" r="1"/></g></svg>')"></div>
    </div>

    <!-- Decorative Top Wave -->
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none">
        <svg class="relative block w-full h-12" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="text-gray-100 fill-current"></path>
        </svg>
    </div>

    <div class="relative z-10 px-4 pt-20 pb-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 gap-8 mb-12 md:grid-cols-2 lg:grid-cols-4">

            <!-- Company Info -->
            <div class="lg:col-span-1">
                <div class="flex items-center mb-6 space-x-3">
                    <div class="p-3 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 12.846 4.632 15 6.414 15H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 5H6.28l-.31-1.243A1 1 0 005 3H4zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-transparent bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text">
                            Lestari Adv
                        </h3>
                        <p class="text-sm text-slate-400">Digital Printing Solutions</p>
                    </div>
                </div>
                <p class="mb-6 leading-relaxed text-slate-300">
                    Solusi lengkap percetakan digital berkualitas tinggi dengan teknologi terdepan dan pelayanan terpercaya sejak 2015.
                </p>

                <!-- Social Media -->
                <div class="flex space-x-4">
                    <a href="https://wa.me/6285810200320" class="p-3 transition-all duration-300 transform rounded-lg group bg-slate-700 hover:bg-green-600 hover:scale-110">
                        <svg class="w-5 h-5 text-slate-300 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.570-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.905 3.488"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Services -->
            <div>
                <h4 class="flex items-center mb-6 text-lg font-semibold text-white">
                    <div class="w-2 h-6 mr-3 rounded-full bg-gradient-to-b from-blue-500 to-purple-600"></div>
                    Layanan Kami
                </h4>
                @foreach ($kategoris as $kategori)
                    <ul class="space-y-3">
                    <li><a class="flex items-center transition-colors duration-200 text-slate-300 hover:text-blue-400 group">
                        <span class="w-2 h-2 mr-3 transition-transform bg-blue-500 rounded-full group-hover:scale-125"></span>
                        {{ $kategori->name }}
                    </a></li>
                </ul>
                @endforeach

            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="flex items-center mb-6 text-lg font-semibold text-white">
                    <div class="w-2 h-6 mr-3 rounded-full bg-gradient-to-b from-blue-500 to-purple-600"></div>
                    Kontak
                </h4>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3 group">
                        <div class="p-2 transition-colors duration-200 rounded-lg bg-slate-700 group-hover:bg-blue-600">
                            <svg class="w-4 h-4 text-slate-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm leading-relaxed text-slate-300">
                                Santa Modern Market Jalan Cisanggiri <br> Blok AKS no 158 Kebayoran Baru Lantai dasar aks 158,
                                <br> Kec. Kby. Baru, Kota Jakarta Selatan, <br> Daerah Khusus Ibukota Jakarta 12160
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 group">
                        <div class="p-2 transition-colors duration-200 rounded-lg bg-slate-700 group-hover:bg-green-600">
                            <svg class="w-4 h-4 text-slate-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <p class="text-slate-300">+62 858 10200320</p>
                    </div>

                    <div class="flex items-center space-x-3 group">
                        <div class="p-2 transition-colors duration-200 rounded-lg bg-slate-700 group-hover:bg-red-600">
                            <svg class="w-4 h-4 text-slate-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <p class="text-slate-300">bilnet18@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="pt-8 border-t border-slate-700">
            <div class="flex flex-col items-center justify-between space-y-4 md:flex-row md:space-y-0">
                <div class="flex flex-col items-center space-y-2 md:flex-row md:space-y-0 md:space-x-6">
                    <p class="text-sm text-slate-400">
                        © 2024 PrintPro. All rights reserved.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a class="transition-colors text-slate-400 hover:text-white">Privacy Policy</a>
                        <a class="transition-colors text-slate-400 hover:text-white">Terms of Service</a>
                        <a href="https://maps.app.goo.gl/SXaVCVZpiNmt7ZrEA" class="transition-colors text-slate-400 hover:text-white">Sitemap</a>
                    </div>
                </div>

                <!-- Back to Top Button -->
                <button
                    onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                    class="p-3 transition-all duration-300 transform rounded-full group bg-slate-700 hover:bg-gradient-to-r hover:from-blue-600 hover:to-purple-600 hover:scale-110"
                >
                    <svg class="w-5 h-5 transition-all duration-200 transform text-slate-300 group-hover:text-white group-hover:-translate-y-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</footer>
