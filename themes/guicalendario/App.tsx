import { Calendar } from "./components/Calendar";

export default function App() {
  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 p-4 md:p-8">
      <div className="max-w-7xl mx-auto">
        <div className="mb-8 text-center">
          <h1 className="text-slate-800 mb-2">Meu Calendário</h1>
          <p className="text-slate-600">Organize seus compromissos e eventos</p>
        </div>
        
        <Calendar />
      </div>
    </div>
  );
}
