<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<!--message-->
<?= $this->include('layout/layout-cell/message') ?>
<!--message-->

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-12 w-auto" src="<?=base_url('/images/resource/logo-bc-300dpi.png')?>" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

        <form class="space-y-6" action="<?=base_url('user/register')?>" method="POST">
            <div>
                <label for="email"
                       class="block text-sm font-medium leading-6 text-gray-900"
                >Email address</label>
                <div class="mt-2">
                    <input id="email"
                           name="email"
                           type="email"
                           autocomplete="on"
                           required
                           class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="name"
                       class="block text-sm font-medium leading-6 text-gray-900"
                >Name</label>
                <div class="mt-2">
                    <input id="name"
                           name="name"
                           type="text"
                           autocomplete="off"
                           required
                           class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="username"
                       class="block text-sm font-medium leading-6 text-gray-900"
                >Username</label>
                <div class="mt-2">
                    <input id="username"
                           name="username"
                           pattern="[A-Za-z0-9]+"
                           type="text"
                           autocomplete="off"
                           required
                           class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="license"
                       class="block text-sm font-medium leading-6 text-gray-900"
                >License</label>
                <div class="mt-2">
                    <input id="license"
                           name="license"
                           type="text"
                           autocomplete="off"
                           required
                           class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="password"
                       class="block text-sm font-medium leading-6 text-gray-900"
                >Password</label>
                <div class="mt-2">
                    <input id="password"
                           name="password"
                           type="password"
                           autocomplete="off"
                           required
                           class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <p class="text-sm text-gray-500">
                <label class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                    <input type="checkbox" onclick="showHide()">
                </label> Tampilkan Password
            </p>

            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
            </div>
        </form>


    </div>
</div>


</body>

<script>
    // show password
    function showHide() {
        var inputan = document.getElementById("password");
        if (inputan.type === "password") {
            inputan.type = "text";
        } else {
            inputan.type = "password";
        }
    }
</script>

</html>