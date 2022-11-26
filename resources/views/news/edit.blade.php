@extends('layouts.layout')
@section('content')

<div class="update">
    <div class="update__wrapper">
        <p class="update__title">Редактирование статьи</p>
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                    {{$error}} 
                    </li>
                @endforeach 
            </ul>
        </div>
        @endif
        <form class="update__form" action="/news/{{$article->id}}" method="post">
          @method("PUT")
            @csrf
          <div class="update__block">
            <label for="nameInput" class="update__label">Название</label>
            <input type="text" class="update__input" name="name" id="nameInput" value="{{$article->name}}">
          </div>
          <div class="update__block">
            <label for="shortDescInput" class="update__label">Описание</label>
            <input type="text" class="update__input" name="shortDesc" id="shortDescInput" value="{{$article->shortDesc}}">
          </div>
          <div class="update__block">
            <label for="dateInput" class="update__label">Дата</label>
            <input type="date" class="update__input" name="date" id="dateInput" value="{{$article->date}}">
          </div>
          <div class="update__block">
            <label for="areaInput" class="update__label">Текст статьи</label>
            <textarea class="update__text-area" name="desc" id="areaInput" value="{{$article->desc}}"></textarea>
          </div>
          <div class="update__container">
            <div class="update__toolbar">
              <div class="update__head">
                <input type="text" placeholder="Filename" value="untitled" id="filename">
                <select onchange="fileHandle(this.value); this.selectedIndex=0">
                  <option value="" selected="" hidden="" disabled="">Файл</option>
                  <option value="new">Новый файл</option>
                  <option value="txt">Созранить в txt</option>
                  <option value="pdf">Сохранить в pdf</option>
                </select>
                <select onchange="formatDoc('formatBlock', this.value); this.selectedIndex=0;">
                  <option value="" selected="" hidden="" disabled="">Формат текста</option>
                  <option value="h1">Heading 1</option>
                  <option value="h2">Heading 2</option>
                  <option value="h3">Heading 3</option>
                  <option value="h4">Heading 4</option>
                  <option value="h5">Heading 5</option>
                  <option value="h6">Heading 6</option>
                  <option value="p">Обычный текст</option>
                </select>
                <select onchange="formatDoc('fontSize', this.value); this.selectedIndex=0;">
                  <option value="" selected="" hidden="" disabled="">Размер текста</option>
                  <option value="1">Очень маленький</option>
                  <option value="2">Маленький</option>
                  <option value="3">Средний</option>
                  <option value="4">Выше среднего</option>
                  <option value="5">Большой</option>
                  <option value="6">Очень большой</option>
                  <option value="7">Огромный</option>
                </select>
                <div class="color">
                  <span>Цвет текста</span>
                  <input type="color" oninput="formatDoc('foreColor', this.value); this.value='#000000';">
                </div>
                <div class="color">
                  <span>Фон текста</span>
                  <input type="color" oninput="formatDoc('hiliteColor', this.value); this.value='#000000';">
                </div>
              </div>
              <div class="btn-toolbar">
                <button onclick="formatDoc('undo'); return false;"><i class='bx bx-undo' ></i></button>
                <button onclick="formatDoc('redo'); return false;"><i class='bx bx-redo' ></i></button>
                <button onclick="formatDoc('bold'); return false;"><i class='bx bx-bold'></i></button>
                <button onclick="formatDoc('underline'); return false;"><i class='bx bx-underline' ></i></button>
                <button onclick="formatDoc('italic'); return false;"><i class='bx bx-italic' ></i></button>
                <button onclick="formatDoc('strikeThrough'); return false;"><i class='bx bx-strikethrough' ></i></button>
                <button onclick="formatDoc('justifyLeft'); return false;"><i class='bx bx-align-left' ></i></button>
                <button onclick="formatDoc('justifyCenter'); return false;"><i class='bx bx-align-middle' ></i></button>
                <button onclick="formatDoc('justifyRight'); return false;"><i class='bx bx-align-right' ></i></button>
                <button onclick="formatDoc('justifyFull'); return false;"><i class='bx bx-align-justify' ></i></button>
                <button onclick="formatDoc('insertOrderedList'); return false;"><i class='bx bx-list-ol' ></i></button>
                <button onclick="formatDoc('insertUnorderedList'); return false;"><i class='bx bx-list-ul' ></i></button>
                <button onclick="addLink(); return false;"><i class='bx bx-link' ></i></button>
                <button onclick="formatDoc('unlink'); return false;"><i class='bx bx-unlink' ></i></button>
                <button id="show-code" data-active="false">&lt;/&gt;</button>
              </div>
            </div>
            <div class="editor__content" id="contentEditor" contenteditable="true" spellcheck="false">
                <?php
                        echo htmlspecialchars_decode($article['desc']);
                    ?>
            </div>
          </div>
          <button onclick="SubmitContent()" type="submit" class="update__button">Изменить</button>  
          <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
          <script>
            function SubmitContent(){
                document.getElementById("areaInput").value = document.getElementById("contentEditor").innerHTML;
                return true;
            }
            
            function formatDoc(cmd, value=null) {
                if(value) {
                document.execCommand(cmd, false, value);
                } else {
                document.execCommand(cmd);
                }
            }
            
            function addLink() {
                const url = prompt('Insert url');
                formatDoc('updateLink', url);
            }
            
            
            
            
            const content = document.getElementById('content');
            
            content.addEventListener('mouseenter', function () {
                const a = content.querySelectorAll('a');
                a.forEach(item=> {
                item.addEventListener('mouseenter', function () {
                    content.setAttribute('contenteditable', false);
                    item.target = '_blank';
                })
                item.addEventListener('mouseleave', function () {
                    content.setAttribute('contenteditable', true);
                })
                })
            })
            
            
            const showCode = document.getElementById('show-code');
            let active = false;
            
            showCode.addEventListener('click', function () {
                showCode.dataset.active = !active;
                active = !active
                if(active) {
                content.textContent = content.innerHTML;
                content.setAttribute('contenteditable', false);
                } else {
                content.innerHTML = content.textContent;
                content.setAttribute('contenteditable', true);
                }
            })
            
            const filename = document.getElementById('filename');
            function fileHandle(value) {
                if(value === 'new') {
                content.innerHTML = '';
                filename.value = 'untitled';
                } else if(value === 'txt') {
                const blob = new Blob([content.innerText])
                const url = URL.updateObjectURL(blob)
                const link = document.updateElement('a');
                link.href = url;
                link.download = `${filename.value}.txt`;
                link.click();
                } else if(value === 'pdf') {
                html2pdf(content).save(filename.value);
                }
            }
        </script>
        </form>
    </div>
</div>
@endsection