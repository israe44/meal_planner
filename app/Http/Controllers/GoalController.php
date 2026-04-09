<?php

namespace App\Http\Controllers;
use App\Models\Goal;
use Illuminate\Http\Request;


class GoalController extends Controller
{
    public function index () {
        $goals = auth()->user()->goals; // Only return the logged-in user's goals
        return response()->json($goals);
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $goal = Goal::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);
        // Attach the goal to the authenticated user
        auth()->user()->goals()->attach($goal->id);
        return response()->json($goal, 201); //201 created
    }

    public function show($id) {
        $goal = Goal::findOrFail($id); // returns 404 automatically if not found
        return response()->json($goal);
    }
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:255',
        ]);

        $goal = Goal::findOrFail($id);
        // Ownership check: only allow if user owns the goal
        if (!auth()->user()->goals->contains($goal->id)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $goal->update($validated);
        return response()->json($goal);
    }
    public function destroy($id) {
        $goal = Goal::findOrFail($id);
        // Ownership check: only allow if user owns the goal
        if (!auth()->user()->goals->contains($goal->id)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $goal->delete();
        return response()->json(['message' => 'Goal deleted successfully']);
    }
    // Assign a goal to the logged-in user
    public function assignGoal($id) {
        $goal = Goal::findOrFail($id);
        $user = auth()->user();
        if ($user->goals->contains($goal->id)) {
            return response()->json(['message' => 'Goal already assigned'], 409);
        }
        $user->goals()->attach($goal->id);
        return response()->json(['message' => 'Goal assigned successfully']);
    }

    // Unassign a goal from the logged-in user
    public function unassignGoal($id) {
        $goal = Goal::findOrFail($id);
        $user = auth()->user();
        if (!$user->goals->contains($goal->id)) {
            return response()->json(['message' => 'Goal not assigned to user'], 404);
        }
        $user->goals()->detach($goal->id);
        return response()->json(['message' => 'Goal unassigned successfully']);
    }
}
