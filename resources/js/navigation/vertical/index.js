export default [
  {heading: 'Dashboard'},
  {
    title: 'Home',
    icon: { icon: 'ri-home-3-line' },
    to: 'dashboard'
  },
  {heading: 'Documents'},
  {
    title: 'Survey',
    icon: { icon: 'ri-survey-line' },
    children: [
      {
        title: 'Conduct Survey',
        to: 'survey-conductsurvey',
      },
      {
        title: 'Survey Records',
        to: 'survey-surveyrecord',
      },
    ],
    badgeClass: 'bg-error',
  },
  {
    title: 'Permit',
    icon: { icon: 'ri-file-text-line' },
    children: [
      {
        title: 'Release Permit',
        to: 'permit-releasepermit',
      },
      {
        title: 'Permit Record',
        to: 'permit-permitrecord',
      },
    ],
    badgeClass: 'bg-error',
  },
  {heading: 'Others'},
  {
    title: 'Profile',
    icon: {icon: 'ri-user-line'},
  },
  {
    title: 'Settings',
    icon: { icon: 'ri-settings-4-line' },
  }
]
