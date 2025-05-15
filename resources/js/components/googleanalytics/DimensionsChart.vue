<script setup lang="ts">
    import { Line } from 'vue-chartjs'
    import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    LineElement,
    CategoryScale,
    LinearScale,
    PointElement,
    } from 'chart.js'

// Chart.js에 사용할 컴포넌트 등록
ChartJS.register(Title, Tooltip, Legend, BarElement,LineElement, CategoryScale, LinearScale, PointElement);

const props = defineProps<{
  chartData: Record<string, number>
  projectName: any
}>();

const nameChange = (projectName: string) => {
  if(projectName === 'kjkPortfolioDimensionsData') {
    return 'KJK-Portfolio';
  } else if(projectName === 'logAndListDimensionsData') {
    return 'Log&List';
  }
};

const chartData = {
  labels: Object.keys(props.chartData),
  datasets: [
    {
      label: 'Total Viwers',
      data: Object.values(props.chartData),
      backgroundColor: '#4f46e5',
      borderColor: '#4f46e5',
      fill: false,
      tension: 0.4, // 곡선 조정
    },
  ]
};

const chartOptions = { 
  responsive: true,
  plugins: {
    legend: {
      position: 'top' as const,
      labels: {
        color: '#374151',
        font: {
          size: 14,
          weight: 'bold',
        },
      },
    },
    title: {
      display: true,
      text: nameChange(props.projectName),
      font: {
        size: 24,  // 폰트 크기
        weight: 'bold',  // 폰트 두께 (예: 'normal', 'bold', 'bolder' 등)
        family: 'Arial',  // 폰트 가족 (선택 사항)
        lineHeight: 1.2,  // 줄 간격
      },
      color: '#000000',  // 텍스트 색상
    },
    tooltip: {
      callbacks: {
        label: (context: any) => `View Count: ${context.formattedValue}`,
      },
    },
  },
  scales: {
    y: {
      beginAtZero: true,
      title: {
        display: true,
        text: 'Visitors by day of the week',
      },
      ticks: {
        stepSize: 1,
      },
    },
    x: {
      title: {
        display: true,
        text: 'Date',
      },
    },
  }
} as const;

</script>

<template>
    <Line 
      :data="chartData" 
      :options="chartOptions" 
    />
</template>
  

  