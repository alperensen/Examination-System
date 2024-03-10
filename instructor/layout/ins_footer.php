        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../js/scripts.js"></script>
        <script>
            function soruEkle() {
                var soruSayisi = document.querySelectorAll('.soru').length + 2;
    
                var yeniSoruDiv = document.createElement('div');
                yeniSoruDiv.className = 'soru mb-3';
                yeniSoruDiv.innerHTML = `
                    <label for="soru${soruSayisi}" class="form-label">Question ${soruSayisi}:</label>
                    <input type="text" class="form-control soruMetni" id="soru${soruSayisi}" required>
                    <label class="form-check-label">Answers:</label>
                    <div class="form-check">
                        <input class="form-check-input rad-style" type="radio" name="secenek${soruSayisi}" id="answer${soruSayisi}A" value="A">
                        <label class="form-check-label" for="answer${soruSayisi}A">A</label>
                        <input type="text" class="form-control secenekMetni" id="answer${soruSayisi}AText" placeholder="Answer A" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input rad-style" type="radio" name="secenek${soruSayisi}" id="answer${soruSayisi}B" value="B">
                        <label class="form-check-label" for="answer${soruSayisi}B">B</label>
                        <input type="text" class="form-control secenekMetni" id="answer${soruSayisi}BText" placeholder="Answer B" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input rad-style" type="radio" name="secenek${soruSayisi}" id="answer${soruSayisi}C" value="C">
                        <label class="form-check-label" for="answer${soruSayisi}C">C</label>
                        <input type="text" class="form-control secenekMetni" id="answer${soruSayisi}CText" placeholder="Answer C" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input rad-style" type="radio" name="secenek${soruSayisi}" id="answer${soruSayisi}D" value="D">
                        <label class="form-check-label" for="answer${soruSayisi}D">D</label>
                        <input type="text" class="form-control secenekMetni" id="answer${soruSayisi}DText" placeholder="Answer D" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input rad-style" type="radio" name="secenek${soruSayisi}" id="answer${soruSayisi}E" value="E">
                        <label class="form-check-label" for="answer${soruSayisi}E">E</label>
                        <input type="text" class="form-control secenekMetni" id="answer${soruSayisi}EText" placeholder="Answer E" required>
                    </div>
                `;
    
                document.getElementById('addExamModal').querySelector('.modal-body').appendChild(yeniSoruDiv);
            }
            function sorulariTemizle() {
            document.querySelectorAll(".examForm").forEach(form => form.reset())
            document.querySelectorAll(".soru").forEach(soruDiv => soruDiv.remove())
            }

            function sonSoruyuSil() {
                document.querySelector(".soru").parentNode.lastChild.remove()
            }
    
    
    
    
            
        </script>
    </body>
</html>