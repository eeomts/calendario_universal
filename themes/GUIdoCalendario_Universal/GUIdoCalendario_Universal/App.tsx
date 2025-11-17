import { Calendar } from "./components/Calendar";

export default function App() {
  return (
    <div className="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 p-4 md:p-8">
      <div className="max-w-7xl mx-auto">
        <div className="mb-8 text-center">
          <h1 className="text-slate-100 mb-2">Calendário Universal</h1>
          <p className="text-slate-400">Organize seus compromissos e eventos</p>
        </div>
        
        <Calendar />
      </div>
    </div>
  );
}