export enum UnitType {
    Years = 'years',
    Months = 'months',
    Weeks = 'weeks',
    Days = 'days',
    Hours = 'hours',
    Minutes = 'minutes',
    Seconds = 'seconds',
}

export enum RoleNames {
    ADMIN = 'Admin',
    USER = 'User',
}

export enum RecurringType {
    Daily = 'daily',
    Weekly = 'weekly',
    BiWeekly = 'bi-weekly',
    Monthly = 'monthly',
    Yearly = 'yearly',
    Custom = 'custom',
}
export interface User {
    id: number;
    name: string;
    email: string;
    is_admin: boolean;
    email_verified_at: string;
}

export interface Event {
    id: number;
    title: string;
    description: string;
    start_date: Date;
    end_date: Date;
    recurrence_type: RecurringType;
    recurrence_interval: number | null;
    logo_url: string;
    color: string | null;
    unit: string;
    user_id: number;
    created_at: Date;
    updated_at: Date;
    date?: Date; // calendar page
    count_down?: number; // home controller
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
