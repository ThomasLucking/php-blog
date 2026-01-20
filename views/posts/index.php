<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>


<main class="grow p-10 flex-col items-start justify-start text-left">
    <div class="flex flex-col gap-y-6 items-start justify-between mr-6">
        <h1 class="text-white text-4xl font-bold">Welcome to the Blog</h1>
        <p class="text-white text-2xs">
            This blog is a demo application as an example for the php blog exercise proposed
            <br>
            in the first year at Jobtrek IT training.
        </p>
        <p class="text-white text-2xs font">
            This blog is built with basic PHP techniques. No Object Oriented Programming or Frameworks. Plain old php,
            some functions and an autoloader. The SQLite database is directly accessed by PDO.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-6 pb-20">
        <div class="block max-w-sm p-6 border-2 rounded-md border-[#1e293b] bg-[#0f172a] shadow-xl mt-20">
            <a href="#">
                <img class="rounded-sm mb-4" src="/assets/nice.jpg" alt="Blog Post" />
            </a>

            <a href="/index.php?page=viewpost">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">
                    Streamlining your design process today.
                </h5>
            </a>

            <p class="mb-6 text-slate-400 text-sm leading-relaxed">
                In today’s fast-paced digital landscape, fostering seamless collaboration among
                Developers and IT Operations.
            </p>

            <a href="/index.php?page=viewpost"
                class="inline-flex items-center bg-[#60a5fa] text-white px-5 py-2.5 rounded font-semibold transition hover:bg-blue-500">
                See post
            </a>
        </div>
        <div class="block max-w-sm p-6 border-2 rounded-md border-[#1e293b] bg-[#0f172a] shadow-xl mt-20">
            <a href="#">
                <img class="rounded-sm mb-4" src="/assets/nice.jpg" alt="Blog Post" />
            </a>

            <a href="/index.php?page=viewpost">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">
                    Streamlining your design process today.
                </h5>
            </a>

            <p class="mb-6 text-slate-400 text-sm leading-relaxed">
                In today’s fast-paced digital landscape, fostering seamless collaboration among
                Developers and IT Operations.
            </p>

            <a href="/index.php?page=viewpost"
                class="inline-flex items-center bg-[#60a5fa] text-white px-5 py-2.5 rounded font-semibold transition hover:bg-blue-500">
                See post
            </a>
        </div>
    </div>
</main>



<?php require_once __DIR__ . '/../partials/footer.php'; ?>