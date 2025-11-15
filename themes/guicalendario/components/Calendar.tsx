import { useState } from "react";
import { ChevronLeft, ChevronRight, Plus, BookOpen } from "lucide-react";
import { Button } from "./ui/button";
import { Card } from "./ui/card";
import { Badge } from "./ui/badge";
import { Dialog, DialogContent, DialogDescription, DialogHeader, DialogTitle, DialogTrigger } from "./ui/dialog";
import { Input } from "./ui/input";
import { Label } from "./ui/label";
import { Switch } from "./ui/switch";

interface Event {
  id: number;
  title: string;
  date: Date;
  color: string;
}

interface Subject {
  id: string;
  name: string;
  active: boolean;
}

export function Calendar() {
  const [currentDate, setCurrentDate] = useState(new Date());
  const [events] = useState<Event[]>([
    { id: 1, title: "Reunião de equipe", date: new Date(2025, 10, 18), color: "bg-blue-500" },
    { id: 2, title: "Apresentação", date: new Date(2025, 10, 20), color: "bg-purple-500" },
    { id: 3, title: "Workshop", date: new Date(2025, 10, 25), color: "bg-green-500" },
    { id: 4, title: "Deadline projeto", date: new Date(2025, 10, 14), color: "bg-red-500" },
  ]);
  const [subjects, setSubjects] = useState<Subject[]>([]);
  const [isDialogOpen, setIsDialogOpen] = useState(false);
  const [newSubjectId, setNewSubjectId] = useState("");
  const [newSubjectName, setNewSubjectName] = useState("");

  const months = [
    "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
    "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
  ];

  const daysOfWeek = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"];

  const getDaysInMonth = (date: Date) => {
    const year = date.getFullYear();
    const month = date.getMonth();
    return new Date(year, month + 1, 0).getDate();
  };

  const getFirstDayOfMonth = (date: Date) => {
    const year = date.getFullYear();
    const month = date.getMonth();
    return new Date(year, month, 1).getDay();
  };

  const previousMonth = () => {
    setCurrentDate(new Date(currentDate.getFullYear(), currentDate.getMonth() - 1));
  };

  const nextMonth = () => {
    setCurrentDate(new Date(currentDate.getFullYear(), currentDate.getMonth() + 1));
  };

  const goToToday = () => {
    setCurrentDate(new Date());
  };

  const addSubject = () => {
    if (newSubjectId.trim() && newSubjectName.trim()) {
      const subjectExists = subjects.some(s => s.id === newSubjectId.trim());
      
      if (subjectExists) {
        alert("Uma matéria com este ID já existe!");
        return;
      }

      setSubjects([...subjects, {
        id: newSubjectId.trim(),
        name: newSubjectName.trim(),
        active: true
      }]);
      setNewSubjectId("");
      setNewSubjectName("");
      setIsDialogOpen(false);
    }
  };

  const toggleSubjectActive = (subjectId: string) => {
    setSubjects(subjects.map(subject =>
      subject.id === subjectId
        ? { ...subject, active: !subject.active }
        : subject
    ));
  };

  const removeSubject = (subjectId: string) => {
    setSubjects(subjects.filter(s => s.id !== subjectId));
  };

  const isToday = (day: number) => {
    const today = new Date();
    return (
      day === today.getDate() &&
      currentDate.getMonth() === today.getMonth() &&
      currentDate.getFullYear() === today.getFullYear()
    );
  };

  const getEventsForDay = (day: number) => {
    return events.filter(event => {
      return (
        event.date.getDate() === day &&
        event.date.getMonth() === currentDate.getMonth() &&
        event.date.getFullYear() === currentDate.getFullYear()
      );
    });
  };

  const daysInMonth = getDaysInMonth(currentDate);
  const firstDay = getFirstDayOfMonth(currentDate);
  const days = [];

  // Adiciona dias vazios do início
  for (let i = 0; i < firstDay; i++) {
    days.push(null);
  }

  // Adiciona os dias do mês
  for (let i = 1; i <= daysInMonth; i++) {
    days.push(i);
  }

  return (
    <div className="grid lg:grid-cols-[1fr_300px] gap-6">
      {/* Calendário Principal */}
      <Card className="p-6 shadow-lg">
        {/* Cabeçalho */}
        <div className="flex items-center justify-between mb-6">
          <div className="flex items-center gap-4">
            <h2 className="text-slate-800">
              {months[currentDate.getMonth()]} {currentDate.getFullYear()}
            </h2>
            <Button onClick={goToToday} variant="outline" size="sm">
              Hoje
            </Button>
          </div>
          
          <div className="flex items-center gap-2">
            <Button onClick={previousMonth} variant="outline" size="icon">
              <ChevronLeft className="h-4 w-4" />
            </Button>
            <Button onClick={nextMonth} variant="outline" size="icon">
              <ChevronRight className="h-4 w-4" />
            </Button>
          </div>
        </div>

        {/* Grid do Calendário */}
        <div className="grid grid-cols-7 gap-2">
          {/* Cabeçalho dos dias da semana */}
          {daysOfWeek.map((day) => (
            <div
              key={day}
              className="text-center py-2 text-slate-600"
            >
              {day}
            </div>
          ))}

          {/* Células dos dias */}
          {days.map((day, index) => {
            const dayEvents = day ? getEventsForDay(day) : [];
            const today = day ? isToday(day) : false;

            return (
              <div
                key={index}
                className={`min-h-[100px] p-2 border rounded-lg transition-all hover:shadow-md ${
                  day ? "bg-white cursor-pointer hover:border-blue-300" : "bg-slate-50"
                } ${today ? "border-blue-500 border-2 bg-blue-50" : "border-slate-200"}`}
              >
                {day && (
                  <>
                    <div
                      className={`text-right mb-1 ${
                        today ? "text-blue-600" : "text-slate-700"
                      }`}
                    >
                      {day}
                    </div>
                    <div className="space-y-1">
                      {dayEvents.map((event) => (
                        <div
                          key={event.id}
                          className={`text-xs text-white px-2 py-1 rounded truncate ${event.color}`}
                          title={event.title}
                        >
                          {event.title}
                        </div>
                      ))}
                    </div>
                  </>
                )}
              </div>
            );
          })}
        </div>
      </Card>

      {/* Painel Lateral - Próximos Eventos */}
      <div className="space-y-6">
        <Card className="p-6 shadow-lg">
          <div className="flex items-center justify-between mb-4">
            <h3 className="text-slate-800">Próximos Eventos</h3>
            <Button size="icon" variant="outline" className="h-8 w-8">
              <Plus className="h-4 w-4" />
            </Button>
          </div>
          
          <div className="space-y-3">
            {events
              .sort((a, b) => a.date.getTime() - b.date.getTime())
              .map((event) => (
                <div
                  key={event.id}
                  className="flex items-start gap-3 p-3 rounded-lg bg-slate-50 hover:bg-slate-100 transition-colors"
                >
                  <div className={`w-3 h-3 rounded-full ${event.color} mt-1 flex-shrink-0`} />
                  <div className="flex-1 min-w-0">
                    <div className="text-slate-800 truncate">{event.title}</div>
                    <div className="text-slate-500">
                      {event.date.toLocaleDateString("pt-BR", {
                        day: "numeric",
                        month: "long",
                      })}
                    </div>
                  </div>
                </div>
              ))}
          </div>
        </Card>

        {/* Card de Estatísticas */}
        <Card className="p-6 shadow-lg">
          <h3 className="text-slate-800 mb-4">Este Mês</h3>
          <div className="space-y-3">
            <div className="flex items-center justify-between">
              <span className="text-slate-600">Total de eventos</span>
              <Badge variant="secondary">{events.length}</Badge>
            </div>
            <div className="flex items-center justify-between">
              <span className="text-slate-600">Dias com eventos</span>
              <Badge variant="secondary">
                {new Set(events.map((e) => e.date.getDate())).size}
              </Badge>
            </div>
          </div>
        </Card>

        {/* Card de Matérias */}
        <Card className="p-6 shadow-lg">
          <div className="flex items-center justify-between mb-4">
            <h3 className="text-slate-800">Matérias</h3>
            <Button size="icon" variant="outline" className="h-8 w-8" onClick={() => setIsDialogOpen(true)}>
              <Plus className="h-4 w-4" />
            </Button>
          </div>
          
          <div className="space-y-3">
            {subjects.map((subject) => (
              <div
                key={subject.id}
                className="flex items-start gap-3 p-3 rounded-lg bg-slate-50 hover:bg-slate-100 transition-colors"
              >
                <div className={`w-3 h-3 rounded-full ${subject.active ? "bg-green-500" : "bg-gray-500"} mt-1 flex-shrink-0`} />
                <div className="flex-1 min-w-0">
                  <div className="text-slate-800 truncate">{subject.name}</div>
                  <div className="text-slate-500">
                    {subject.active ? "Ativa" : "Inativa"}
                  </div>
                </div>
                <div className="flex items-center gap-2">
                  <Switch
                    checked={subject.active}
                    onCheckedChange={() => toggleSubjectActive(subject.id)}
                  />
                  <Button size="icon" variant="outline" className="h-8 w-8" onClick={() => removeSubject(subject.id)}>
                    <BookOpen className="h-4 w-4" />
                  </Button>
                </div>
              </div>
            ))}
          </div>
        </Card>
      </div>

      {/* Dialog para Adicionar Matéria */}
      <Dialog open={isDialogOpen} onOpenChange={setIsDialogOpen}>
        <DialogContent className="sm:max-w-[425px]">
          <DialogHeader>
            <DialogTitle>Adicionar Matéria</DialogTitle>
            <DialogDescription>
              Adicione uma nova matéria para o calendário.
            </DialogDescription>
          </DialogHeader>
          <div className="space-y-4">
            <div className="space-y-2">
              <Label htmlFor="subjectId">ID da Matéria</Label>
              <Input
                id="subjectId"
                placeholder="Ex: MATH101"
                value={newSubjectId}
                onChange={(e) => setNewSubjectId(e.target.value)}
              />
            </div>
            <div className="space-y-2">
              <Label htmlFor="subjectName">Nome da Matéria</Label>
              <Input
                id="subjectName"
                placeholder="Ex: Matemática"
                value={newSubjectName}
                onChange={(e) => setNewSubjectName(e.target.value)}
              />
            </div>
          </div>
          <div className="mt-6 flex justify-end">
            <Button
              type="button"
              variant="outline"
              onClick={() => setIsDialogOpen(false)}
            >
              Cancelar
            </Button>
            <Button
              type="button"
              className="ml-2"
              onClick={addSubject}
            >
              Adicionar
            </Button>
          </div>
        </DialogContent>
      </Dialog>
    </div>
  );
}