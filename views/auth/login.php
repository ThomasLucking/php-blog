<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="grow flex items-center justify-center">
    <div class="w-full max-w-sm p-6 border-2 rounded-md border-slate-800 bg-slate-900 shadow-xl">
        <form action="#">
            <h5 class="text-xl font-bold text-white mb-6">Sign in to our platform</h5>
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-white">Your username</label>
                <input type="text" id="name"
                    class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full px-3 py-2.5 placeholder:text-slate-500 outline-none"
                    placeholder="example@company.com" required />
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-medium text-white">Your email</label>
                <input type="email" id="email"
                    class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full px-3 py-2.5 placeholder:text-slate-500 outline-none"
                    placeholder="example@company.com" required />
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-2 text-sm font-medium text-white">Your password</label>
                <input type="password" id="password"
                    class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full px-3 py-2.5 placeholder:text-slate-500 outline-none"
                    placeholder="" required />
            </div>

            <div class="flex items-start my-6">
                <div class="flex items-center">
                    <input id="checkbox-remember" type="checkbox"
                        class="w-4 h-4 border border-[#1e293b] rounded bg-slate-800 focus:ring-2 focus:ring-[#60a5fa]">
                    <label for="checkbox-remember" class="ms-2 text-sm font-medium text-white">Remember me</label>
                </div>
            </div>

            <button type="submit"
                class="text-white bg-[#60a5fa] hover:bg-blue-500 font-bold rounded text-sm px-4 py-2.5 w-full mb-3 transition">
                Login to your account
            </button>

            <div class="text-sm font-medium text-slate-400">
                Not registered? <a href="/index.php?page=register" class="text-[#60a5fa] hover:underline">Create account</a>
            </div>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>