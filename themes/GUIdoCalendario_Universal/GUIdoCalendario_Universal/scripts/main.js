$(document).ready(function() {
    // Estado da aplicação
    let currentDate = new Date();
    let subjects = [];
    
    const events = [
        { id: 1, title: "Reunião de equipe", date: new Date(2025, 10, 18), color: "event-blue" },
        { id: 2, title: "Apresentação", date: new Date(2025, 10, 20), color: "event-purple" },
        { id: 3, title: "Workshop", date: new Date(2025, 10, 25), color: "event-green" },
        { id: 4, title: "Deadline projeto", date: new Date(2025, 10, 14), color: "event-red" }
    ];

    const months = [
        "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
    ];

    // Funções auxiliares
    function getDaysInMonth(date) {
        const year = date.getFullYear();
        const month = date.getMonth();
        return new Date(year, month + 1, 0).getDate();
    }

    function getFirstDayOfMonth(date) {
        const year = date.getFullYear();
        const month = date.getMonth();
        return new Date(year, month, 1).getDay();
    }

    function isToday(day) {
        const today = new Date();
        return (
            day === today.getDate() &&
            currentDate.getMonth() === today.getMonth() &&
            currentDate.getFullYear() === today.getFullYear()
        );
    }

    function getEventsForDay(day) {
        return events.filter(event => {
            return (
                event.date.getDate() === day &&
                event.date.getMonth() === currentDate.getMonth() &&
                event.date.getFullYear() === currentDate.getFullYear()
            );
        });
    }

    function formatDate(date) {
        const options = { day: 'numeric', month: 'long' };
        return date.toLocaleDateString('pt-BR', options);
    }

    // Renderizar calendário
    function renderCalendar() {
        const monthYear = `${months[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
        $('#current-month-year').text(monthYear);

        const daysInMonth = getDaysInMonth(currentDate);
        const firstDay = getFirstDayOfMonth(currentDate);
        
        let html = '';

        // Dias vazios do início
        for (let i = 0; i < firstDay; i++) {
            html += '<div class="calendar-day empty"></div>';
        }

        // Dias do mês
        for (let day = 1; day <= daysInMonth; day++) {
            const todayClass = isToday(day) ? 'today' : '';
            const dayEvents = getEventsForDay(day);
            
            html += `<div class="calendar-day ${todayClass}">`;
            html += `<div class="day-number">${day}</div>`;
            
            if (dayEvents.length > 0) {
                html += '<div class="day-events">';
                dayEvents.forEach(event => {
                    html += `<div class="event-item ${event.color}" title="${event.title}">${event.title}</div>`;
                });
                html += '</div>';
            }
            
            html += '</div>';
        }

        $('#calendar-days').html(html);
    }

    // Renderizar eventos
    function renderEvents() {
        const sortedEvents = events.sort((a, b) => a.date.getTime() - b.date.getTime());
        let html = '';

        sortedEvents.forEach(event => {
            const colorClass = event.color.replace('event-', '');
            html += `
                <div class="event-card">
                    <div class="event-dot event-${colorClass}"></div>
                    <div class="event-info">
                        <div class="event-title">${event.title}</div>
                        <div class="event-date">${formatDate(event.date)}</div>
                    </div>
                </div>
            `;
        });

        $('#events-list').html(html);
        updateStats();
    }

    // Atualizar estatísticas
    function updateStats() {
        const currentMonthEvents = events.filter(event => {
            return (
                event.date.getMonth() === currentDate.getMonth() &&
                event.date.getFullYear() === currentDate.getFullYear()
            );
        });

        const uniqueDays = new Set(currentMonthEvents.map(e => e.date.getDate())).size;

        $('#total-events').text(currentMonthEvents.length);
        $('#days-with-events').text(uniqueDays);
    }

    // Renderizar matérias
    function renderSubjects() {
        if (subjects.length === 0) {
            $('#subjects-list').html(`
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                    <p>Nenhuma matéria adicionada</p>
                </div>
            `);
            return;
        }

        let html = '';
        subjects.forEach(subject => {
            const activeClass = subject.active ? 'active' : 'inactive';
            const statusText = subject.active ? 'Ativa' : 'Inativa';
            const toggleClass = subject.active ? 'active' : '';

            html += `
                <div class="subject-item" data-subject-id="${subject.id}">
                    <div class="subject-left">
                        <div class="subject-indicator ${activeClass}"></div>
                        <div class="subject-info">
                            <div class="subject-name">${subject.name}</div>
                            <div class="subject-id">${subject.id}</div>
                        </div>
                    </div>
                    <div class="subject-right">
                        <div class="subject-status">${statusText}</div>
                        <div class="toggle-switch ${toggleClass}" data-subject-id="${subject.id}">
                            <div class="toggle-thumb"></div>
                        </div>
                    </div>
                </div>
            `;
        });

        $('#subjects-list').html(html);
    }

    // Event handlers
    $('#prev-month').on('click', function() {
        currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1);
        renderCalendar();
        updateStats();
    });

    $('#next-month').on('click', function() {
        currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1);
        renderCalendar();
        updateStats();
    });

    $('#today-btn').on('click', function() {
        currentDate = new Date();
        renderCalendar();
        updateStats();
    });

    // Modal
    $('#add-subject-btn').on('click', function() {
        $('#subject-modal').addClass('open');
    });

    $('#close-modal').on('click', function() {
        $('#subject-modal').removeClass('open');
        $('#subject-id').val('');
        $('#subject-name').val('');
    });

    // Fechar modal ao clicar fora
    $('#subject-modal').on('click', function(e) {
        if (e.target === this) {
            $(this).removeClass('open');
            $('#subject-id').val('');
            $('#subject-name').val('');
        }
    });

    // Adicionar matéria
    $('#submit-subject').on('click', function() {
        const subjectId = $('#subject-id').val().trim();
        const subjectName = $('#subject-name').val().trim();

        if (!subjectId || !subjectName) {
            alert('Por favor, preencha todos os campos!');
            return;
        }

        const exists = subjects.some(s => s.id === subjectId);
        if (exists) {
            alert('Uma matéria com este ID já existe!');
            return;
        }

        subjects.push({
            id: subjectId,
            name: subjectName,
            active: true
        });

        renderSubjects();
        $('#subject-modal').removeClass('open');
        $('#subject-id').val('');
        $('#subject-name').val('');
    });

    // Toggle matéria (delegação de eventos)
    $(document).on('click', '.toggle-switch', function() {
        const subjectId = $(this).data('subject-id');
        const subject = subjects.find(s => s.id === subjectId);
        
        if (subject) {
            subject.active = !subject.active;
            renderSubjects();
        }
    });

    // Tecla Enter nos inputs
    $('#subject-id, #subject-name').on('keypress', function(e) {
        if (e.which === 13) {
            $('#submit-subject').click();
        }
    });

    // Inicializar
    renderCalendar();
    renderEvents();
    renderSubjects();
});
