    <table class="table table-bordered covid-program">
        <tr>
            <th colspan="5" class="font-weight-bolder">
                COVID-19 ауруы кезінде өмірді жинақтаушы емес (мерзімді) сақтандыруды
            </th>
        </tr>
        <tbody>
        <tr>
            <th colspan="5" class="font-weight-bolder">1.Сипаттамасы</th>
        </tr>
        <tr>
            <th scope="row">Төлеу шарттары</th>
            <td colspan="5" style="border: none;">Бір уақытт</td>
        </tr>
        <tr>
            <th scope="row">Сақтандыру мерзімі</th>
            <td style="border: none;">12 ай</td>
        </tr>
        <tr>
            <th>Қамтылатын тәуекелдер</th>
            <td colspan="5" style="border: none">- анықталған және сақтанушының ауруханаға жатқызылуына әкеп
                соқтырған ауру
                COVID-19 коронавирустық инфекциясы, сақтандыру мерзімі төлемінің
                қолданылу ішінде бір рет;
                <br>
                - салдарынан сақтандыру шартының қолданылу кезеңінде болған
                сақтанушының қайтыс болуы жағдайын қоспағанда, COVID-19
                коронавирустық инфекциясынан туындаған ауру қаупі
            </td>
        </tr>
        <tr>
            <th scope="row">Жас шектеулері</th>
            <td colspan="5" style="border: none">18-ден бастап 65-ке дейін</td>
        </tr>
        <tr>
            <th scope="row">Шектеулер</th>
            <td colspan="5" style="border: none">Сақтандыру сомасының 100%-ы тәуекелге ұшырайды</td>
        </tr>
        <tr>
            <th scope="row">Шартты немесе ережеде көзделген.</th>
            <td colspan="5" style="border: none">Жауапкершілік территориясы Қазақстан Республикасы</td>
        </tr>
        </tbody>
        <tr>
            <th colspan="5" class="font-weight-bolder">2.Есептеме</th>
        </tr>
        @if(request('id') == "1")
            @include('mini_parts.program_1')
        @elseif(request('id') == "2")
            @include('mini_parts.program_2')
        @elseif(request('id') == "3")
            @include('mini_parts.program_3')
        @else
            <tr>
                <th>Сақтандыру кезені</th>
                <td style="border: none;"><span style="font-weight: bold">12 ай</span></td>
            </tr>
            <tr>
                <th>Жалпы сақтандыру шарттары</th>
                <th>1-ші бағдарлама</th>
                <th>2-ші бағдарлама</th>
                <th>3-ші бағдарлама</th>
            </tr>
            <tr>
                <th>Жалпы сақтандыру сомасы</th>
                <td>1 000 000</td>
                <td>2 000 000</td>
                <td>3 000 000</td>
            </tr>
            <tr>
                <th>Ауруханаға жатқызу</th>
                <td>100 000</td>
                <td>200 000</td>
                <td>300 000</td>
            </tr>
            <tr>
                <th>Өлім</th>
                <td>900 000</td>
                <td>1 800 000</td>
                <td>2 700 000</td>
            </tr>
            <tr>
                <th>Сақтандыру сыйлықақысы</th>
                <td>9 900</td>
                <td>18 000</td>
                <td>26 100</td>
            </tr>
            <tr>
                <th>Жылдық мөлшерлеме</th>
                <td>0,99%</td>
                <td>0,90%</td>
                <td>0,87%</td>
            </tr>
        @endif
        <tr>
            <th colspan="5" class="font-weight-bolder">3.Сақтандыру төлемдері</th>
        </tr>
        <tr>
            <th scope="row">Ауруханаға жатқызу</th>
            <td colspan="" style="border: none">Осы тәуекел үшін сақтандыру сомасының 100%</td>
        </tr>
        <tr>
            <th scope="row">Өлім</th>
            <td style="border: none">Осы тәуекел үшін сақтандыру сомасының 100%</td>
        </tr>
        <tr>
            <th colspan="5" class="font-weight-bolder">4.Ерекше шарттар:</th>
        </tr>
        <tr>
            <td colspan="5" style="border: none;">1. Сақтанушы Қазақстан Республикасының Резиденті болып табылады. Сақтанушы сақтанушы
                болып қалады.
            </td>
        </tr>
        <tr>
            <td colspan="5" style="border: none">2.Сақтанушы стационарға жатқызудың бенифицары болып табылады. Сақтанушының Қазақстан
                Республикасының заңнамасына сәйкес мұрагерлері қайтыс болған жағдайда пайда алушылар
                болып табылады.
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border: none">3.Сақтандыру мерзімі сақтандыруды қорғау мерзіміне тең.
            </td>
        </tr>
        <tr>
            <td colspan="3" style="border: none">4. Сақтандыру төлемінің қолданылу мерзімі сақтандыру шартына қол қойылғаннан /жасалғаннан
                кейін күнтізбелік 7 (жеті) күннен кейін басталады.
            </td>
        </tr>
    </table>


