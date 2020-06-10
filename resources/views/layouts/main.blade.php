<table>
    <tr>
        <td>
            <form action="/main">
                <button>Главная</button>
            </form>
        </td>
        <td>
            <form action="/dishes/alldishes">
                <button>Меню</button>
            </form>
        </td>
        <td>
            <form action="/reservations/index">
                <button>Бронирования</button>
            </form>
        </td>
        <td>
            <form action="/events/index">
                <button>Мероприятия</button>
            </form>
        </td>
        <td>
            <form action="/about">
                <button>О нас</button>
            </form>
        </td>
    </tr>
</table>
<main class="container">
    @yield('content')
</main>
